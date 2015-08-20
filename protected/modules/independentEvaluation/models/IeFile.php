<?php

/**
 * This is the model class for table "ie_file".
 *
 * The followings are the available columns in table 'ie_file':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $file
 * @property integer $file_type
 * @property integer $date
 * @property integer $doc_type
 */
class IeFile extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ie_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('file, file_type, doc_type', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>500),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, file, file_type, date, doc_type', 'safe', 'on'=>'search'),
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
            'docType' => array(self::BELONGS_TO, 'CategoryDoc', 'doc_type'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Наименование',
			'description' => 'Описание',
			'file' => 'Файл',
			'file_type' => 'Тип файла',
			'date' => 'Дата',
			'doc_type' => 'Тип документа',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('file',$this->file);
		$criteria->compare('file_type',$this->file_type);
		$criteria->compare('date',$this->date);
		$criteria->compare('doc_type',$this->doc_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IeFile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'DateFieldBehavior' => array(
                'class' => 'DateFieldBehavior',
                'dateFormat' => 'd-m-Y',
                'defaultDate' => strtotime(date('d-m-Y')),
            ),
        );
    }
}
