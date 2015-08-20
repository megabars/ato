<?php

/**
 * This is the model class for table "ac_public".
 *
 * The followings are the available columns in table 'ac_public':
 * @property integer $id
 * @property integer $portal_id
 * @property integer $post_type_id
 * @property string $fio
 * @property string $post
 * @property integer $file
 * @property integer $year
 * @property integer $type
 */
class AcPublic extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ac_public';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year', 'required'),
			array('portal_id, post_type_id, file, year, type', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>4, 'min'=>4),
			array('fio', 'length', 'max'=>255),
			array('post', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portal_id, post_type_id, fio, post, file, year, type', 'safe', 'on'=>'search'),
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
            'originFile' => array(self::BELONGS_TO, 'File', 'file'),
            'postType' => array(self::BELONGS_TO, 'categoryPost', 'post_type_id'),
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
			'post_type_id' => 'Категория должности',
			'fio' => 'ФИО',
			'post' => 'Должность',
			'file' => 'Файл',
			'year' => 'Год',
			'type' => 'Тип',
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
		$criteria->compare('post_type_id',$this->post_type_id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('post',$this->post,true);
		$criteria->compare('file',$this->file);
		$criteria->compare('year',$this->year);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AcPublic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
