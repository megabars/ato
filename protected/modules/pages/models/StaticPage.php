<?php

/**
 * This is the model class for table "static_page".
 *
 * The followings are the available columns in table 'static_page':
 * @property integer $id
 * @property integer $portal_id
 * @property string $title
 * @property string $url_id
 * @property integer $state
 * @property string $description
 * @property string $preview
 * @property string $date
 * @property integer $photo_gallery_id
 * @property integer $video_gallery_id
 * @property integer $file_group_id
 * @property integer $type_id
 * @property integer $links_group_id
 * @property integer $additional_menu_id
 * @property integer $news_category_id
 * @property integer $map_id
 * @property string $external_link
 * @property integer $is_deleted
 */

class StaticPage extends BaseActiveRecord
{
    public $type_id = RecordType::DEF;

    /**
     * При создании страницы надо инициализоровать несколько связей,
     * например группы ссылок или группы документов прикрепленных к странице
     */
    public function afterFind(){

        if (Yii::app() instanceof CConsoleApplication) {
            return true;
        }

        if ($this->file_group_id == null
            OR $this->pageFolders === null
            OR $this->pageFolders->isNewRecord) {
            // группа документов
            $folders = new FoldersGroup();
            $folders->alias = 'auto_generated_folder_group_pageId_' . $this->id;
            $folders->save();
            $this->file_group_id = $folders->id;
        }


        if ($this->links_group_id == null
            OR $this->pageLinks === null
            OR $this->pageLinks->isNewRecord) {
            // группа ссылок
            $links = new LinksGroup();
            $links->alias = 'auto_generated_links_group_pageId_' . $this->id;
            $links->save();
            $this->links_group_id = $links->id;
        }

        if ($this->photo_gallery_id == null
            OR $this->pageGallery === null
            OR $this->pageGallery->isNewRecord) {
            // фотогаллерея
            $photo = new PhotoGallery();
            $photo->title = 'auto_generated_gallery_pageId_' . $this->id;
            $photo->save();
            $this->photo_gallery_id = $photo->id;
        }

        if ($this->news_category_id == null
            OR $this->pageNews === null
            OR $this->pageNews->isNewRecord) {
            // категория новости
            $news = new NewsType();
            $news->alias = 'auto_generated_news_category_pageId_' . $this->id;
            $news->title = 'Категория для страницы "'. $this->id.'"';
            $news->save();
            $this->news_category_id = $news->id;
        }

        $this->save();

        $this->modify = time();

        parent::afterFind();

    }

    /**
     * @todo добавить как-то в defaultScopes. что-то типа Events::model()->count() сработает неправильно, вернет все
     */
    public function type(){
        $this->getDbCriteria()->mergeWith(array(
            'condition'  => 't.type_id ='. $this->type_id
        ));

        return $this;
    }

    public function behaviors(){
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date', 'modify')
            ),

            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'static_pages',
                'fields' => array(
                    array(
                        'field' => 'image_id',
                        'small'  => array('width' => 200, 'height' => 200),
                        'medium' => array('width' => 470, 'height' => 308),
                    ),
                ),
            ),
        );
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'static_page';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portal_id, title, date', 'required'),

			array('map_id', 'required', 'on' => 'region'),
            array ('map_id', 'unique', 'criteria' => array(
                    'condition'=>'portal_id=:portal_id',
                    'params'=>array(':portal_id'=>$this->portal_id),
                ), 'on' => 'region',
                'message'=>'Элемент карты {value} для данного портала уже существует'
            ),
            array('external_link', 'url', 'validateIDN'=>true, 'defaultScheme' => 'http'),
			array('portal_id, state, photo_gallery_id, video_gallery_id, file_group_id, type_id, links_group_id, additional_menu_id, map_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('url_id, external_link', 'length', 'max'=>500),
			array('url_id, file_id, image_id, description, preview, date, modify, info_thread, social', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, portal_id, title, url, state, description, preview, date, photo_gallery_id, video_gallery_id, file_group_id, type_id, links_group_id, additional_menu_id', 'safe', 'on'=>'search'),
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
            'url' => array(self::BELONGS_TO, 'UrlManager', 'url_id'),
            'attachment' => array(self::BELONGS_TO, 'File', 'file_id'),
            'image' => array(self::BELONGS_TO, 'File', 'image_id'),
            'executives' => array(self::HAS_MANY, 'PageExecutives', 'page_id'),
            'pageGallery' => array(self::BELONGS_TO, 'PageGallery', 'photo_gallery_id'),
//            'pageVideo' => array(self::BELONGS_TO, 'Video', 'video_gallery_id'),
            'pageVideo' => array(self::BELONGS_TO, 'VideoGalleryVideos', 'video_id'),
            'pageFolders' => array(self::BELONGS_TO, 'FoldersGroup', 'file_group_id'),
            'pageFacts' => array(self::HAS_MANY, 'PageFacts', 'page_id'),
            'pageLinks' => array(self::BELONGS_TO, 'LinksGroup', 'links_group_id'),
            'pageNews' => array(self::BELONGS_TO, 'NewsType', 'news_category_id'),
            'mapItem' => array(self::BELONGS_TO, 'Maps', 'map_id'),
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
			'title' => 'Наименование',
			'url' => 'Адрес страницы',
			'state' => 'Статус',
			'description' => 'Описание',
			'preview' => 'Анонс',
			'date' => 'Дата',
			'photo_gallery_id' => 'Фотогалерея',
			'video_gallery_id' => 'Видеогалерея',
			'file_group_id' => 'Файлы',
			'type_id' => 'Тип страницы',
			'links_group_id' => 'Ссылки',
			'additional_menu_id' => 'Дополнительное меню',
            'info_thread' => 'Модуль инфопоток',
            'social' => 'Поделиться в соц. сетях',
            'file_id' => 'Файл',
            'map_id' => 'Элемент карты',
            'external_link' => 'Ссылка на внешний ресурс',
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
		$criteria->compare('portal_id',$this->portal_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('preview',$this->preview,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('photo_gallery_id',$this->photo_gallery_id);
		$criteria->compare('video_gallery_id',$this->video_gallery_id);
		$criteria->compare('file_group_id',$this->file_group_id);
		$criteria->compare('type_id',$this->type_id);
//		$criteria->compare('facts_list_id',$this->facts_list_id);
		$criteria->compare('links_group_id',$this->links_group_id);
		$criteria->compare('additional_menu_id',$this->additional_menu_id);
		$criteria->compare('map_id',$this->map_id);
		$criteria->compare('external_link',$this->external_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StaticPage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function afterSave(){
        parent::afterSave();

        $navItem = NavItems::model()->with('url')->removed()->findByAttributes(array('url_id'=>$this->url_id));
        if($navItem!=null && $this->is_deleted == BaseActiveRecord::STATUS_DEFAULT) {
            $navItem->is_deleted = BaseActiveRecord::STATUS_DEFAULT;
            $navItem->navItemUrl = @$navItem->url->url;
            if (!$navItem->save())
                throw new CHttpException(500, 'Не удалось восстановить элемент меню');
        }
    }
}
