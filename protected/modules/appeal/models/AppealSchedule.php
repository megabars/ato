<?php

/**
 * This is the model class for table "appeal_schedule".
 *
 * The followings are the available columns in table 'appeal_schedule':
 * @property integer $id
 * @property integer $portal_id
 * @property integer $is_deleted
 * @property integer $people_id
 * @property integer $date
 * @property integer $time_start
 * @property integer $time_end
 * @property string $week_days
 */
class AppealSchedule extends BaseActiveRecord
{
    public static $days = array(
        1 => 'ПН',
        2 => 'ВТ',
        3 => 'СР',
        4 => 'ЧТ',
        5 => 'ПТ',
        6 => 'СБ',
        7 => 'ВС',
    );

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ReceptionSchedule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appeal_schedule';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('people_id', 'required'),
            array('portal_id, is_deleted, people_id', 'numerical', 'integerOnly' => true),
			array('week_days', 'length', 'max'=>255),
			array('week_days', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, portal_id, is_deleted, people_id, date, time_start, time_end, week_days', 'safe', 'on'=>'search'),
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
            'people' => array(self::BELONGS_TO, 'People', 'people_id'),
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
            'people_id' => 'Персона',
            'date' => 'Дата приема',
            'time_start' => 'Время начала приема',
            'time_end' => 'Время окончания приема',
            'week_days' => 'Дни недели',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('portal_id',$this->portal_id);
		$criteria->compare('people_id',$this->people_id);
		$criteria->compare('date',$this->date);
		$criteria->compare('time_start',$this->time_start);
		$criteria->compare('time_end',$this->time_end);
		$criteria->compare('week_days',$this->week_days,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    public function behaviors()
    {
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date','time_start','time_end')
            ),
        );
    }

    public function afterFind()
    {
        if ($this->week_days != null) {
            $this->week_days = unserialize($this->week_days);
        }

        parent::afterFind();
    }

    public function getWeekDays() {
        $days = array();
        foreach($this->week_days as $week_day)
            $days[] = AppealSchedule::$days[(int)$week_day];

        return implode(', ', $days);
    }
}