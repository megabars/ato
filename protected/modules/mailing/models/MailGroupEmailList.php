<?php

/**
 * This is the model class for table "mail_group_email_list".
 *
 * The followings are the available columns in table 'mail_group_email_list':
 * @property integer $id
 * @property integer $list_id
 * @property integer $group_id
 */
class MailGroupEmailList extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_group_email_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('list_id','validationListGroupValidate'),
			array('list_id, group_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, list_id, group_id', 'safe', 'on'=>'search'),
		);
	}

	public function validationListGroupValidate($attribute,$params)
	{
		if($model = self::model()->findByAttributes(array('list_id'=>$this->list_id,'group_id'=>$this->group_id)))
			if($model->id!=$this->id)
				$this->addError('list_id','Данный email уже добавлен в эту группу');
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'groups' => array(self::BELONGS_TO, 'MailGroup', 'group_id'),
			'list' => array(self::BELONGS_TO, 'MailEmailList', 'list_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'list_id' => 'E-mail',
			'group_id' => 'Группа',
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
		$criteria->compare('list_id',$this->list_id);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailGroupEmailList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
