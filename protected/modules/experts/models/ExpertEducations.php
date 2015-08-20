<?php

/**
 * This is the model class for table "expert_educations".
 *
 * The followings are the available columns in table 'expert_educations':
 * @property integer $id
 * @property integer $expert_id
 * @property string $year
 * @property string $specialty
 * @property string $institution
 * @property string $additional
 * @property integer $is_deleted
 */
class ExpertEducations extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expert_educations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expert_id, year', 'required'),
			array('expert_id, is_deleted', 'numerical', 'integerOnly'=>true),
			array('year', 'length', 'max'=>50),
			array('specialty, institution', 'length', 'max'=>255),
			array('additional', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, expert_id, year, specialty, institution, additional, is_deleted', 'safe', 'on'=>'search'),
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
			'expert_id' => 'Эксперт',
			'year' => 'Год окончания',
			'specialty' => 'Специальность по диплому',
			'institution' => 'Наименование учебного заведения',
			'additional' => 'Дополнительное образование',
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
		$criteria->compare('expert_id',$this->expert_id);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('specialty',$this->specialty,true);
		$criteria->compare('institution',$this->institution,true);
		$criteria->compare('additional',$this->additional,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExpertEducations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
