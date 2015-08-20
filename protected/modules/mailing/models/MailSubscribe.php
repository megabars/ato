<?php

/**
 * This is the model class for table "mail_subscribe".
 *
 * The followings are the available columns in table 'mail_subscribe':
 * @property integer $id
 * @property integer $group_id
 * @property integer $template_id
 * @property string $sender_email
 * @property integer $date
 * @property integer $is_send
 * @property string $name
 */
class MailSubscribe extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_subscribe';
	}

	protected function beforeSave()
	{
		$model = new Log();
		$model->attributes = array(
			'changedModel' => get_called_class(),
			'typeOfChange' => ($this->isNewRecord) ? 'create' : 'update',
			'userId' => 0,
			'date' => time()
		);

		$model->save();

		return TRUE;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,group_id, template_id, date', 'required'),
			array('group_id, template_id, date, is_send', 'numerical', 'integerOnly'=>true),
			array('sender_email, name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, group_id, template_id, sender_email, date, is_send, name', 'safe', 'on'=>'search'),
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
			'group' => array(self::BELONGS_TO, 'MailGroup', 'group_id'),
			'template' => array(self::BELONGS_TO, 'MailTemplate', 'template_id'),
			'files' => array(self::HAS_MANY, 'MailSubscribeFiles', 'subscribe_id'),
			'filesCount' => array(self::STAT, 'MailSubscribeFiles', 'subscribe_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'group_id' => 'Группа',
			'template_id' => 'Шаблон',
			'sender_email' => 'Адрес отправителя',
			'date' => 'Дата',
			'is_send' => 'Отправлено',
			'name' => 'Название рассылки',
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
		$criteria->compare('group_id',$this->group_id);
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('sender_email',$this->sender_email,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('is_send',$this->is_send);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailSubscribe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
