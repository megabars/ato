<?php

/**
 * This is the model class for table "discuss".
 *
 * The followings are the available columns in table 'discuss':
 * @property integer $id
 * @property integer $portal_id
 * @property string $title
 * @property string $type
 * @property integer $date_actual
 * @property integer $date_finish
 * @property integer $date_publish
 * @property integer $file
 * @property integer $executive_id
 */
class Npa extends BaseActiveRecord
{
    public $year;
    public $month;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'project_npa';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('executive_id, title', 'required'),
            array('portal_id, date_actual, date_finish, date_publish, file', 'numerical', 'integerOnly' => TRUE),
            array('type', 'length', 'max' => 255),
            array('title', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, date_actual, date_finish, date_publish, type, file, year, month', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'executive' => array(self::BELONGS_TO, 'Executive', 'executive_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'portal_id' => 'Портал',
            'title' => 'Название',
            'date_actual' => 'Дата обновления',
            'date_finish' => 'Дата окончания',
            'date_publish' => 'Дата публикации',
            'type' => 'Тип',
            'file' => 'Файл',
            'month' => 'Месяц',
            'year' => 'Год',
            'executive_id' => 'Орган исполнительной власти',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('date_actual', $this->date_actual);
        $criteria->compare('date_finish', $this->date_finish);
        $criteria->compare('date_publish', $this->date_publish);
        $criteria->compare('type', $this->type);
        $criteria->compare('file', $this->file);
        $criteria->compare('executive_id', $this->executive_id);

        if (($this->year) && ($this->year > 0))
        {
            $min_month = ($this->month && $this->month > 0)  ? $this->month : 0;
            $max_month = ($this->month && $this->month > 0) ? $this->month + 1 : 12;
            $criteria->condition = 'date_finish >= :min_date AND date_finish < :max_date';
            $criteria->params = array(
                'min_date' => mktime(0, 0, 0, $min_month, 1, $this->year),
                'max_date' => mktime(0, 0, 0, $max_month, 1, $this->year),
            );
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Discuss the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function portaled()
    {
        if (Yii::app()->controller->isMainPortal())
            return $this->allPortalsCriteria();

        return $this;
    }

    public function archived()
    {
        $date = time();
        $this->getDbCriteria()->mergeWith(
            array('condition' => "t.date_finish <= {$date}"));

        return $this;
    }
}
