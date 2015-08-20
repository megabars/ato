<?php

/**
 * This is the model class for table "people_staff".
 *
 * The followings are the available columns in table 'people_staff':
 * @property integer $id
 * @property integer $people_id
 * @property integer $photo
 * @property string $full_name
 * @property string $job
 * @property string $cabinet
 * @property string $contact_phone
 * @property string $contact_fax
 * @property string $contact_email
 * @property integer $portal_id
 * @property string $date
 * @property integer $unit_id
 * @property integer $is_deleted
 * @property integer $main
 */
class PeopleStaff extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'people_staff';
	}

	public function behaviors()
	{
		return array(
			'ImageBehavior' => array(
				'class'  => 'ImageBehavior',
				'module'=>'people',
				'fields' => array(
					array(
						'field' => 'photo',
						'small'  => array('width' => 200, 'height' => 200),
                        'medium' => array('width' => 80, 'height' => 100),
					),
				),
			),
			'DateFieldBehavior' => array(
				'class'  => 'DateFieldBehavior'
			)
		);
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('people_id, photo, portal_id, unit_id, is_deleted, main', 'numerical', 'integerOnly'=>true),
			array('full_name, cabinet, contact_phone, contact_fax, contact_email, date', 'length', 'max'=>255),
			array('job', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
            array('id, people_id, photo, full_name, job, cabinet, contact_phone, contact_fax, contact_email, portal_id, date, unit_id, is_deleted, main', 'safe', 'on'=>'search'),
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
			'file' => array(self::BELONGS_TO, 'File', 'photo'),
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
			'people_id' => 'Персоналия',
			'photo' => 'Фото',
			'portal_id' => 'Портал',
			'full_name' => 'ФИО',
			'job' => 'Место работы, должность, род занятий',
			'cabinet' => 'Кабинет',
			'contact_phone' => 'Телефон',
			'contact_fax' => 'Факс',
			'contact_email' => 'E-mail',
            'date' => 'Date',
            'unit_id' => 'Ведомство',
            'is_deleted' => 'Is Deleted',
            'main' => 'Руководитель',
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
		$criteria->compare('people_id',$this->people_id);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('cabinet',$this->cabinet,true);
		$criteria->compare('contact_phone',$this->contact_phone,true);
		$criteria->compare('contact_fax',$this->contact_fax,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('unit_id',$this->unit_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PeopleStaff the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
