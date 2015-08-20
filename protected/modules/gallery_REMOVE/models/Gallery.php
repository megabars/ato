<?php

/**
 * This is the model class for table "video_gallery".
 *
 * The followings are the available columns in table 'video_gallery':
 * @property integer $id
 * @property integer $portal_id
 * @property string $title
 * @property integer $type
 * @property integer $date
 * @property integer $photo
 * @property string $preview
 * @property string $description
 * @property integer $state
 * @property string $alias
 */
class Gallery extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'gallery';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portal_id, title, type', 'required'),
			array('portal_id, date, photo, state, type', 'numerical', 'integerOnly'=>true),
			array('title, alias', 'length', 'max'=>255),
			array('preview, description', 'safe'),
            array('photos, videos, audios, files, alias, date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, portal_id, title, date, photo, preview, description, state, alias', 'safe', 'on'=>'search'),
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
            'galleryPhotos' => array(self::HAS_MANY, 'GalleryPhotos', 'photo_gallery_id'),
            'galleryVideos' => array(self::HAS_MANY, 'GalleryVideos', 'gallery_id'),
            'galleryAudios' => array(self::HAS_MANY, 'GalleryAudios', 'gallery_id'),
//            'galleryFiles' => array(self::HAS_MANY, 'GalleryFiles', 'gallery_id'),
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'portal_id' => 'Portal',
			'title' => 'Наименование галереи',
			'type' => 'Тип галереи',
			'date' => 'Дата',
			'photo' => 'Превьюшка',
			'preview' => 'Краткое описание',
			'description' => 'Описание',
			'state' => 'Опубликовано',
			'alias' => 'Алиас',
			'photos' => 'Фотографии',
			'videos' => 'Видеофайлы',
			'audios' => 'Аудиофайлы',
			'files' => 'Файлы',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('portal_id',$this->portal_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('date',$this->date);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('alias',$this->alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave()
    {
        if (parent::beforeSave())
        {
            if ($this->isNewRecord && !$this->date)
                $this->date = time();

            return TRUE;
        }

        return FALSE;
    }
}