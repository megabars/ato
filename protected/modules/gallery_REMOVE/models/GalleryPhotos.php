<?php

/**
 * This is the model class for table "photo_gallery_photos".
 *
 * The followings are the available columns in table 'photo_gallery_photos':
 * @property string $id
 * @property integer $photo_gallery_id
 * @property string $title
 * @property integer $photo
 * @property integer $state
 * @property integer $ordi
 *
 * The followings are the available model relations:
 * @property PhotoGallery $photoGallery
 */
class GalleryPhotos extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'photo_gallery_photos'; //todo переименовать таблицу в gallery_photos
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('photo_gallery_id', 'required'),
            array('photo_gallery_id, photo, state, ordi', 'numerical', 'integerOnly' => TRUE),
            array('title', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, photo_gallery_id, title, photo, state, ordi', 'safe', 'on' => 'search'),
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
            'gallery' => array(self::BELONGS_TO, 'Gallery', 'photo_gallery_id'), //todo переименовать поле в gallery_id для красоты, так сказать
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'photo_gallery_id' => 'Photo Gallery',
            'title' => 'Title',
            'photo' => 'Photo',
            'state' => 'State',
            'ordi' => 'Ordi',
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

        $criteria->compare('id', $this->id, TRUE);
        $criteria->compare('photo_gallery_id', $this->photo_gallery_id);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('state', $this->state);
        $criteria->compare('ordi', $this->ordi);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>array(
                'pageSize'=>26,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PhotoGalleryPhotos the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'photoGalleryPhotos',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 130, 'height' => 100),
                        'medium' => array('width' => 300, 'height' => 300),
                    ),
                ),
            ),
        );
    }
}
