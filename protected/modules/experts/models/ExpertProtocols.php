<?php

/**
 * This is the model class for table "expert_protocols".
 *
 * The followings are the available columns in table 'expert_protocols':
 * @property integer $id
 * @property integer $date
 * @property string $type
 * @property string $number
 * @property string $descr
 * @property integer $file_id
 * @property integer $is_deleted
 */
class ExpertProtocols extends CActiveRecord
{
    public $expertsHelperIds = array();

    public function behaviors(){
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date')
            ),
        );
    }

    public function getAuthorsString(){
        $result = array();

        $data = $this->authors;

        if (is_array($data))
            foreach ($this->authors as $ex)
                $result[] = $ex->expertHelper->name;

        return implode(',', $result);

    }

    public function afterFind(){
        parent::afterFind();

        $data = $this->authors;

        if (is_array($data))
            foreach ($this->authors as $ex)
                $this->expertsHelperIds[] = $ex->expert_adviser_id;

    }

    public function saveRelated($data){
        $delete = ExpertProtocolsAuthors::model()->deleteAllByAttributes(array('protocol_id' => $this->id));

        if (!is_array($data))
            return true;

        foreach ($data as $expertId) {
            $model = new ExpertProtocolsAuthors();
            $model->attributes = array(
                'protocol_id' => $this->id,
                'expert_adviser_id' => $expertId
            );

            $model->save();
        }

    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'required'),
			array('is_deleted', 'numerical', 'integerOnly'=>true),
			array('type, number', 'length', 'max'=>255),

            array('descr, file_id, expertsHelperIds', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date, type, number, file_id, is_deleted', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'expert_protocols';
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'authors' => array(self::HAS_MANY, 'ExpertProtocolsAuthors', 'protocol_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'date' => 'Дата',
			'type' => 'Тип',
			'number' => 'Номер',
			'file_id' => 'Файл',
            'descr' => 'Примечание',
            'expertsHelperIds' => 'Экспертный совет',
			'is_deleted' => 'Is Deleted',
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
		$criteria->compare('date',$this->date);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('descr',$this->descr,true);
		$criteria->compare('file_id',$this->file_id);
		$criteria->compare('is_deleted',$this->is_deleted);

        if (!is_array($this->expertsHelperIds)) {
            $criteria->with = array('authors');
            $criteria->together = true;
            $criteria->compare('authors.expert_adviser_id', $this->expertsHelperIds);
        }


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExpertProtocols the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
