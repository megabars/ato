<?php

/**
 * This is the model class for table "maps".
 *
 * The followings are the available columns in table 'maps':
 * @property integer $id
 * @property string $name
 * @property string $head
 * @property string $area
 * @property string $people
 * @property string $site
 * @property string $path
 * @property integer $pos_x
 * @property integer $pos_y
 */
class Maps extends BaseActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'maps';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, path, pos_x, pos_y', 'required'),
			array('pos_x, pos_y', 'numerical', 'integerOnly'=>true),
			array('name, head, site', 'length', 'max'=>255),
            array('site', 'url', 'validateIDN'=>true, 'defaultScheme' => 'http'),
			array('area, people', 'length', 'max'=>50),
            array('area, people', 'filter', 'filter' =>  array($this, 'convertToFloat')),
			array('area, people', 'type', 'type'=>'float', 'message'=>'Необходимо ввести только значение'),
            array('area, people', 'filter', 'filter' =>  array($this, 'convertToFloatReverse')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, head, area, people, site, path, pos_x, pos_y', 'safe', 'on'=>'search'),
		);
	}

    function convertToFloat($value) {
        return trim(str_replace(',', '.', $value));
    }
    function convertToFloatReverse($value) {
        return str_replace('.', ',', $value);
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
			'name' => 'Наименование',
			'head' => 'Глава района',
			'area' => 'Территория',
			'people' => 'Население',
			'site' => 'Сайт',
			'is_city' => 'Является городом',
			'path' => 'Path',
			'pos_x' => 'Pos X',
			'pos_y' => 'Pos Y',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('head',$this->head,true);
		$criteria->compare('area',$this->area,true);
		$criteria->compare('people',$this->people,true);
		$criteria->compare('site',$this->site,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('pos_x',$this->pos_x);
		$criteria->compare('pos_y',$this->pos_y);
		$criteria->compare('is_city',$this->is_city);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Maps the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function sorted($sort = 'DESC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "t.order {$sort}",
        ));

        return $this;
    }
}
