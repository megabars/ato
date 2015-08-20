<?php

/**
 * This is the model class for table "photo_gallery".
 *
 * The followings are the available columns in table 'photo_gallery':
 * @property string $id
 * @property integer $portal_id
 * @property string $title
 * @property integer $date
 * @property integer $photo
 * @property string $preview
 * @property string $description
 * @property integer $state
 * @property string $alias
 *
 * The followings are the available model relations:
 * @property PhotoGalleryPhotos[] $photoGalleryPhotos
 */
class PhotoGallery extends BaseActiveRecord
{
//    public $photos = array();

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'photo_gallery';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, title', 'required'),
            array('portal_id, photo, state', 'numerical', 'integerOnly' => TRUE),
            array('title', 'length', 'max' => 255),
            array('preview, description', 'safe'),
            array('photos, alias, date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, date, photo, preview, description, state', 'safe', 'on' => 'search'),
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
            'photoGalleryPhotos' => array(self::HAS_MANY, 'PhotoGalleryPhotos', 'photo_gallery_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'portal_id' => 'Портал',
            'title' => 'Название',
            'date' => 'Дата',
            'photo' => 'Фото',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'state' => 'Опубликовано',
            'photos' => 'Фотографии',
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
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('title', $this->title, TRUE);

        $criteria->addCondition("t.title not like 'auto_generated_gallery_pageId_%'");

        $criteria->compare('date', $this->date);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('preview', $this->preview, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('state', $this->state);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id DESC',
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PhotoGallery the static model class
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
                'module' => 'photoGallery',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 130, 'height' => 100),
                        'medium' => array('width' => 300, 'height' => 300),
                    ),
                ),
            ),
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior'
            )
        );
    }

    /**
     * Удаляем из галереи фотографии id файлов которых нет в параметре
     */
    public function updateGallery($currentFilesIds){

        $photoIds = array();

        foreach ($currentFilesIds as $photo) {

            if (!is_numeric($photo))
                continue;

            $existingPhoto = modelFactory::get('PhotoGalleryPhotos', array(
                    'photo' => $photo,
                    'photo_gallery_id' => $this->id,
                )
            );

            if ($existingPhoto->save())
                $photoIds[] = $existingPhoto->id;
        }

        $criteria = new CDbCriteria();
        $criteria->compare('photo_gallery_id', $this->id);
        $criteria->addNotInCondition('id', $photoIds);
        PhotoGalleryPhotos::model()->deleteAll($criteria);
    }

    /**
     * Удаляем из галереи фотографии без файлов
     */
    public function afterFind()
    {
        foreach ($this->photoGalleryPhotos as $item) {
            if ($item->file === null) {
                $item->delete();
            }
        }

        parent::afterFind();
    }

    public function published() {

        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'state = 1 AND date <= ' . time(),
        ));

        return $this;
    }

}
