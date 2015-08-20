<?php

/**
 * This is the model class for table "gubernator_info".
 *
 * The followings are the available columns in table 'gubernator_info':
 * @property integer $id
 * @property string $fio
 * @property integer $image
 */
class GubernatorInfo extends BaseActiveRecord
{
	public function tableName()
	{
		return 'gubernator_info';
	}

	public function rules()
	{
		return array(
			array('fio, photo', 'required'),
			array('photo', 'numerical', 'integerOnly'=>true),
			array('fio', 'length', 'max'=>255),
			array('id, fio, photo, type', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fio' => 'Полное имя',
			'photo' => 'Фотография',
			'type' => 'Type',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function behaviors()
	{
		return array(
			'ImageBehavior' => array(
				'class'  => 'ImageBehavior',
				'module' => 'gubernator',
				'fields' => array(
					array(
						'field' => 'photo',
						'small' => array('width' => 220, 'height' => 270),
					),
				),
			),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
