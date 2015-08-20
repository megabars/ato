<?php

/**
 * This is the model class for table "contact".
 *
 * The followings are the available columns in table 'contact':
 * @property integer $id
 * @property integer $portal_id
 * @property string $alias
 * @property string $address
 * @property integer $photo
 * @property string $driving_directions
 * @property string $description
 */
class Contact extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('executive_id', 'required'),
			array('portal_id, photo', 'numerical', 'integerOnly'=>true),
			array('address', 'length', 'max'=>500),
			array('alias', 'unique'),
            array (
                'executive_id',
                'unique',
                'criteria' => array(
                    'condition'=>'portal_id=:portal_id',
                    'params'=>array(':portal_id'=>$this->portal_id),
                ),
                'message'=>'Контактные данные уже были созданы для этого департамента'
            ),
			array('alias', 'length', 'max'=>100),
			array('driving_directions, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portal_id, alias, address, photo, driving_directions, description', 'safe', 'on'=>'search'),
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
            'phone' => array(self::HAS_MANY, 'ContactDetails', 'contact_id', 'condition'=>'type='.ContactType::PHONE),
            'fax' => array(self::HAS_MANY, 'ContactDetails', 'contact_id', 'condition'=>'type='.ContactType::FAX),
            'hotline' => array(self::HAS_MANY, 'ContactDetails', 'contact_id', 'condition'=>'type='.ContactType::HOTLINE),
            'email' => array(self::HAS_MANY, 'ContactDetails', 'contact_id', 'condition'=>'type='.ContactType::EMAIL),
            'web' => array(self::HAS_MANY, 'ContactDetails', 'contact_id', 'condition'=>'type='.ContactType::WEB),
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
			'alias' => 'Блок контактов',
			'address' => 'Адрес',
			'photo' => 'Фотография',
			'driving_directions' => 'Схема проезда',
			'description' => 'Описание',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('portal_id',$this->portal_id);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('driving_directions',$this->driving_directions,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('executive_id',$this->executive_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Contact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'contact',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 120, 'height' => 120),
                        'medium' => array('width' => 299, 'height' => 241),
                    ),
                ),
            ),
        );
    }
}
