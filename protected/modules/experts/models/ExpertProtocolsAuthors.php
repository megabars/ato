<?php

/**
 * This is the model class for table "expert_protocols_authors".
 *
 * The followings are the available columns in table 'expert_protocols_authors':
 * @property integer $id
 * @property integer $protocol_id
 * @property integer $expert_adviser_id
 */
class ExpertProtocolsAuthors extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expert_protocols_authors';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('protocol_id, expert_adviser_id', 'required'),
			array('protocol_id, expert_adviser_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, protocol_id, expert_adviser_id', 'safe', 'on'=>'search'),
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
            'expertHelper' => array(self::BELONGS_TO, 'ExpertsHelper', 'expert_adviser_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'protocol_id' => 'Protocol',
			'expert_adviser_id' => 'Expert Adviser',
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
		$criteria->compare('protocol_id',$this->protocol_id);
		$criteria->compare('expert_adviser_id',$this->expert_adviser_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExpertProtocolsAuthors the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
