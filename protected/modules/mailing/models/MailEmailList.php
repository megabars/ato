<?php

/**
 * This is the model class for table "mail_email_list".
 *
 * The followings are the available columns in table 'mail_email_list':
 * @property integer $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $surname
 * @property integer $agreement
 * @property integer $is_alert
 */
class MailEmailList extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail_email_list';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'unique'),
			array('email', 'required'),
			array('email', 'email'),
			array('agreement, is_alert', 'numerical', 'integerOnly'=>true),
			array('email, first_name, last_name, surname', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, email, first_name, last_name, surname, agreement, is_alert', 'safe', 'on'=>'search'),
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
			'email' => 'E-mail',
			'first_name' => 'Имя',
			'last_name' => 'Фамилия',
			'surname' => 'Отчество',
			'agreement' => 'Согласие',
			'is_alert' => 'Оповещен',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('agreement',$this->agreement);
		$criteria->compare('is_alert',$this->is_alert);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			//'sort'=>array('defaultOrder'=>'email')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MailEmailList the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
}
