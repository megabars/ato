<?php

/**
 * This is the model class for table "links".
 *
 * The followings are the available columns in table 'links':
 * @property integer $id
 * @property integer $group_id
 * @property string $title
 * @property string $url
 * @property integer $photo
 * @property integer $ordi
 */
class Links extends BaseActiveRecord
{
    public $limit = false;

    public function getPortalCriteria(){

        return array(
            'condition' => '"group"."portal_id" = :portal_id',
            'with' => 'group',
            'params' => array('portal_id' => isset(Yii::app()->getController()->portalId) ? Yii::app()->getController()->portalId : 1)
        );
    }


    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'links';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, url', 'required'),
            array('photo, ordi', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('url', 'length', 'max' => 500),
            array('photo, page_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, url, photo, ordi', 'safe', 'on' => 'search'),
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
            'group' => array(self::BELONGS_TO, 'LinksGroup', 'group_id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'url' => 'Адрес',
            'photo' => 'Фото',
            'ordi' => 'Порядок',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('ordi', $this->ordi);
        $criteria->compare('group_id', $this->group_id);

        if($this->limit)
            $criteria->limit=$this->limit;

        $dataProvider = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'ordi DESC',
            )
        ));

        if($this->limit)
            $dataProvider->setPagination(false);

        return $dataProvider;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Links the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'OrderBehavior' => array(
                'class'  => 'OrderBehavior',
            ),
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'links',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 90, 'height' => 90),
                    ),
                ),
            ),
        );
    }

    public function sorted($sort = 'desc')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "ordi {$sort}",
        ));

        return $this;
    }
}
