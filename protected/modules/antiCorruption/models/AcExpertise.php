<?php

/**
 * This is the model class for table "ac_expertise".
 *
 * The followings are the available columns in table 'ac_expertise':
 * @property integer $id
 * @property integer $portal_id
 * @property string $title
 * @property integer $file
 * @property integer $date_start
 * @property integer $date_finish
 * @property integer $date_publish
 * @property integer $executive_id
 * @property string $description
 */
class AcExpertise extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ac_expertise';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portal_id, file, executive_id', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portal_id, file, date_start, date_finish, date_publish, executive_id, description', 'safe', 'on'=>'search'),
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
			'title' => 'Наименование',
			'file' => 'Файл',
			'date_start' => 'Начало',
			'date_finish' => 'Окончание',
			'date_publish' => 'Размещено',
			'executive_id' => 'Орган исполнительной власти',
			'description' => 'Текст проекта',
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

//        $criteria->compare('title',$this->title,true);
        $criteria->addSearchCondition('LOWER(t.title)', mb_convert_case($this->title, MB_CASE_LOWER, 'utf8'), true);

		$criteria->compare('file',$this->file);
		$criteria->compare('date_start',$this->date_start);
		$criteria->compare('date_finish',$this->date_finish);
		$criteria->compare('date_publish',$this->date_publish);
		$criteria->compare('executive_id',$this->executive_id);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AcExpertise the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
