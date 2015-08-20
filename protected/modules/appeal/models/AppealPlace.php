<?php

/**
 * This is the model class for table "appeal_place".
 *
 * The followings are the available columns in table 'appeal_place':
 * @property integer $id
 * @property integer $portal_id
 * @property string $department
 * @property string $address
 * @property string $time
 * @property string $head
 * @property string $phone
 * @property string $email
 * @property string $description
 */
class AppealPlace extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appeal_place';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portal_id', 'numerical', 'integerOnly'=>true),
			array('department, address, time', 'length', 'max'=>500),
			array('head, phone, email', 'length', 'max'=>100),
			array('email', 'email'),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portal_id, department, address, time, head, phone, email, description', 'safe', 'on'=>'search'),
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
			'department' => 'Отдел',
			'address' => 'Адрес',
			'time' => 'Время работы',
			'head' => 'Начальник отдела',
			'phone' => 'Телефон',
			'email' => 'E-mail',
			'description' => 'Дополнительная информация',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('portal_id',$this->portal_id);
		$criteria->compare('department',$this->department,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('head',$this->head,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppealPlace the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
