<?php

/**
 * This is the model class for table "vote_user".
 *
 * The followings are the available columns in table 'vote_user':
 * @property integer $id
 * @property integer $vote_id
 * @property integer $vote_item_id
 * @property integer $user_id
 * @property string $ip_address
 *
 * The followings are the available model relations:
 * @property VoteItem $voteItem
 */
class VoteUser extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vote_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('vote_id, vote_item_id', 'required'),
            array('vote_id, vote_item_id', 'numerical', 'integerOnly' => true),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, vote_id, vote_item_id, ip_address', 'safe', 'on' => 'search'),
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
            'voteItem' => array(self::BELONGS_TO, 'VoteItem', 'vote_item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'vote_id' => 'Vote',
            'vote_item_id' => 'Vote Item',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('vote_id', $this->vote_id);
        $criteria->compare('vote_item_id', $this->vote_item_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return VoteUser the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}