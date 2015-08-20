<?php

/**
 * This is the model class for table "rating_doc".
 *
 * The followings are the available columns in table 'rating_doc':
 * @property integer $id
 * @property string $title
 * @property string $author
 * @property string $info
 * @property integer $file
 * @property integer $global_type
 * @property integer $type
 * @property integer $date
 */
class RatingDoc extends BaseActiveRecord
{

    public $year;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'rating_doc';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, global_type', 'required'),
            array('file, global_type, type, date, year', 'numerical', 'integerOnly'=>true),
            array('title, info, author', 'length', 'max'=>500),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, author, info, file, files, global_type, type, year', 'safe', 'on'=>'search'),
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
            'files' => array(self::HAS_MANY, 'RatingProjectFile', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Наименование',
            'author' => 'Разработчик или иной субъект нормотворческой деятельности',
            'year' => 'Год',
            'info' => 'Номер и дата принятия',
            'file' => 'Файл', // если не проект, то пишем файл сюда.
            'global_type' => 'Глобальный тип',
            'type' => 'Тип проекта',
            'date' => 'Дата размещения',
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

        $encoding = 'utf-8';
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('LOWER(title)',mb_strtolower($this->title, $encoding),true);
        $criteria->compare('LOWER(author)',mb_strtolower($this->author, $encoding),true);
        $criteria->compare('LOWER(info)',mb_strtolower($this->info, $encoding),true);
        $criteria->compare('file',$this->file);
        $criteria->compare('global_type',$this->global_type);
        $criteria->compare('type',$this->type);

        if ($this->year) {
            $min_date = mktime(0, 0, 0, 1, 1, $this->year);
            $max_date = mktime(0, 0, 0, 1, 1, $this->year + 1);
            $criteria->addCondition("date >= {$min_date} AND date < {$max_date}");
        }

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RatingDoc the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getByType($type)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'global_type = '. $type,
        ));
        return $this;
    }

    public function getTitleWithLink()
    {
        return $this->title . '<br/>' . CHtml::link('Скачать', array('/files/front/download', 'id' => $this->file));
    }

    public function getTypeName()
    {
        return RatingLocalType::instance()->list[$this->global_type][$this->type];
    }

    public function getFilesList() {
        $return = '';
        foreach ($this->files as $file)
        {
            $return .= CHtml::link($file->title, array('/files/front/download', 'id' => $file->file)) . ' ' . $file->description . '<br/>';
        }
        return $return;
    }

    public function dateFormat()
    {
        return date('d.m.Y', $this->date);
    }
}