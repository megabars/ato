<?php

/**
 * This is the model class for table "independent_evaluation".
 *
 * The followings are the available columns in table 'independent_evaluation':
 * @property integer $id
 * @property string $link
 * @property integer $portal_group_id
 * @property integer $executive_id
 */
class IndependentEvaluation extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'independent_evaluation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('link, portal_group_id, executive_id', 'required'),
			array('portal_group_id, executive_id', 'numerical', 'integerOnly'=>true),
			array('link', 'length', 'max'=>500),
			array('link', 'unique'),
            array('link', 'url', 'validateIDN'=>true, 'defaultScheme' => 'http'),
            array (
                'portal_group_id',
                'unique',
                'criteria' => array(
                    'condition'=>'portal_group_id=:portal_group_id AND executive_id=:executive_id',
                    'params'=>array(
                        ':portal_group_id'=>(int)$this->portal_group_id,
                        ':executive_id'=>(int)$this->executive_id,
                    ),
                ),
                'message'=>'Ссылка с такими параметрами уже существует'
            ),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, link, portal_group_id, executive_id', 'safe', 'on'=>'search'),
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
            'executive' => array(self::BELONGS_TO, 'Executive', 'executive_id'),
            'portalGroup' => array(self::BELONGS_TO, 'PortalGroup', 'portal_group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'link' => 'Ссылка',
			'portal_group_id' => 'Сфера',
			'executive_id' => 'ИОГВ',
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('portal_group_id',$this->portal_group_id);
		$criteria->compare('executive_id',$this->executive_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IndependentEvaluation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
