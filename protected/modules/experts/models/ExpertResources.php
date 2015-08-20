<?php

/**
 * This is the model class for table "expert_resources".
 *
 * The followings are the available columns in table 'expert_resources':
 * @property integer $id
 * @property integer $expert_id
 * @property integer $type
 * @property string $value
 * @property integer $is_deleted
 */
class ExpertResources extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'expert_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('expert_id, type, value', 'required'),
			array('expert_id, type, is_deleted', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, expert_id, type, value, is_deleted', 'safe', 'on'=>'search'),
		);
	}

    public function validateUrls($attribute) {
        if (is_array($this->$attribute)) {
            foreach ($this->$attribute as $key=>$value) {
                if(!empty($value)) {
                    $validator = new CUrlValidator;
                    $validator->defaultScheme = 'http';
                    $validator->validateIDN = true;
                    if(!$validator->validateValue($value))
                        $this->addError("{$attribute}[{$key}]", 'Адрес некорректен');
                }
            }
        }
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
			'type' => 'Тип',
			'value' => 'Значение',
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
		$criteria->compare('type',$this->type);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('is_deleted',$this->is_deleted);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExpertResources the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    protected function afterValidate(){
        if($this->type == ContactType::WEB || $this->type == ContactType::BLOG || $this->type == ContactType::SOCIAL) {
            $validator = new CUrlValidator;
            $validator->defaultScheme = 'http';
            $validator->validateIDN = true;
            $value = $validator->validateValue($this->value);
            if($value)
                $this->value = $value;
        }

        parent::afterValidate();
    }
}
