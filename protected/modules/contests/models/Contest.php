<?php

/**
 * This is the model class for table "contest".
 *
 * The followings are the available columns in table 'contest':
 * @property int    'id'
 * @property string 'org'
 * @property string 'title'
 * @property string 'description_small'
 * @property string 'description'
 * @property integer 'date_start'
 * @property integer 'date_end'
 * @property integer 'date_placed'
 * @property integer 'file'
 * @property integer 'state'
 * @property integer 'portal_id'
 */
class Contest extends BaseActiveRecord
{
    const STATUS_OPENED       = 0;    // Открыт
    const STATUS_CLOSED     = 1;    // Итог
    const STATUS_ARCHIVED    = 2;    // Архив

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'contest';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('org, title', 'required'),
            array('title', 'length', 'max' => 255),
            array('org', 'length', 'max' => 255),
            array('description_small', 'length', 'max' => 500),
            array('portal_id', 'safe'),
            array('id, org, title, description_small, description, date_start, date_end, date_placed, file, state', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
           'id' 				=> 'Идентификатор',
           'org'				=> 'Организатор',
           'title'				=> 'Название конкурса',
           'description_small'	=> 'Описание',
           'description'		=> 'Полное описание',
           'date_start'		    => 'Начало',
           'date_end'		    => 'Окончание',
           'date_placed'	    => 'Размещено',
           'file'				=> 'Результаты',
           'state'			    => 'Статус',
        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('org',$this->org,true);
        $criteria->compare('title',$this->title,true);
        $criteria->compare('description_small',$this->description_small,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('date_start',$this->date_start);
        $criteria->compare('date_end',$this->date_end);
        $criteria->compare('date_placed',$this->date_placed);
        $criteria->compare('file',$this->file);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Afisha the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function _withStatus($status)
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.state = '. $status,
        ));
        return $this;
    }


    public function opened()
    {
        return $this->_withStatus(self::STATUS_OPENED);
    }

    public function closed()
    {
        return $this->_withStatus(self::STATUS_CLOSED);
    }

    public function archived()
    {
        return $this->_withStatus(self::STATUS_ARCHIVED);
    }

    public function getPeriods()
    {
        $labels = $this->attributeLabels();
        $suffixes = array(
            'start',
            'end',
            'placed',
        );
        $result = '';
        foreach ($suffixes as $suffix)
        {
            $field = 'date_'.$suffix;
            $result .= '<b>'.$labels[$field].':</b>'. date('d.m.Y', $this->$field) . '<br/>';
        }
        return $result;
    }

    public function getStatus()
    {
        $statuses = array(
            self::STATUS_OPENED => 'Открытый',
            self::STATUS_CLOSED => 'Завершенный',
            self::STATUS_ARCHIVED => 'В архиве',
        );
        return $statuses[$this->state];
    }

    public function getTitleWithLink()
    {
        return CHtml::link($this->title, array('view', 'id' => $this->id));
    }

    public function getFileLink()
    {
        if ($this->file)
            return  CHtml::link('Скачать', array('/files/front/download', 'id' => $this->file));
        else
            return 'Файл не загружен';
    }

}
