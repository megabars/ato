<?php

/**
 * This is the model class for table "news".
 *
 * The followings are the available columns in table 'news':
 * @property integer $id
 * @property integer $portal_id
 * @property string $author
 * @property integer $date
 * @property string $photo
 * @property string $title
 * @property string $preview
 * @property string $description
 * @property integer $state
 * @property integer $type
 * @property integer $photo_title
 * @property integer $modify
 * @property integer $photo_gallery_id
 * @property integer $video_gallery_id
 * @property integer $file_group_id
 * @property integer $links_group_id
 */
class News extends BaseActiveRecord
{
    public $status;
    public $module;
    public $limit = false;


    public function afterConstruct(){
        if ($this->url_id === null){
            $this->url = new UrlManager();
        }
        parent::afterConstruct();
    }

    public function afterFind(){
        if ($this->url_id === null){
            $this->url = new UrlManager();
        }
        $this->modify = time();
        parent::afterFind();

        if (Yii::app() instanceof CConsoleApplication) {
            return true;
        }

        if ($this->file_group_id == null
            OR $this->pageFolders === null
            OR $this->pageFolders->isNewRecord) {
            // группа документов
            $folders = new FoldersGroup();
            $folders->alias = 'auto_generated_folder_group_newsId_' . $this->id;
            $folders->save();
            $this->file_group_id = $folders->id;
        }

        if ($this->links_group_id == null
            OR $this->pageLinks === null
            OR $this->pageLinks->isNewRecord) {
            // группа ссылок
            $links = new LinksGroup();
            $links->alias = 'auto_generated_links_group_newsId_' . $this->id;
            $links->save();
            $this->links_group_id = $links->id;
        }

        if ($this->photo_gallery_id == null
            OR $this->pageGallery === null
            OR $this->pageGallery->isNewRecord) {
            // фотогаллерея
            $photo = new PhotoGallery();
            $photo->title = 'auto_generated_gallery_newsId_' . $this->id;
            $photo->save();
            $this->photo_gallery_id = $photo->id;
        }

        $this->save();
    }

    public function beforeSave(){
        parent::beforeSave();
        if (isset($_POST['UrlManager'])) {
            if ($this->url_id === null){
                $this->url = new UrlManager();
                $this->url->save();
                $this->url_id = $this->url->id;
            }
        }

        return true;
    }

    public function afterSave(){
        if (isset($_POST['UrlManager'])) {
//            $this->refresh();
            $this->url->attributes = $_POST['UrlManager'];
            $this->url->save();
        }

        return parent::afterSave();
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return News the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'news';
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
            array('portal_id, state, type', 'numerical', 'integerOnly'=>true),
            array('author, photo, title', 'length', 'max' => 255),
            array('social, preview, description, date, modify', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, portal_id, author, date, photo, title, preview, description, state, type, photo_title', 'safe', 'on'=>'search'),
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
            'news_type' => array(self::BELONGS_TO, 'NewsType', 'type'),
            'url' => array(self::BELONGS_TO, 'UrlManager', 'url_id'),
            'pageGallery' => array(self::BELONGS_TO, 'PageGallery', 'photo_gallery_id'),
            'pageVideo' => array(self::BELONGS_TO, 'VideoGalleryVideos', 'video_id'),
            'pageFolders' => array(self::BELONGS_TO, 'FoldersGroup', 'file_group_id'),
            'pageLinks' => array(self::BELONGS_TO, 'LinksGroup', 'links_group_id'),

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
            'author' => 'Автор',
            'date' => 'Дата публикации',
            'photo' => 'Фото',
            'title' => 'Заголовок',
            'social' => 'Поделиться в соц. сетях',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'state' => 'Опубликовано',
            'type' => 'Тип',
            'photo_title' => 'Подпись к фото',
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('author', $this->author, true);
//        $criteria->compare('date', $this->date);
        $criteria->compare('photo', $this->photo, true);
//        $criteria->compare('title', $this->title, true);
        $criteria->addSearchCondition('LOWER(t.title)', mb_convert_case($this->title, MB_CASE_LOWER, 'utf8'), true);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('type',$this->type);

        if($this->limit)
            $criteria->limit=$this->limit;

        $dataProvider = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'id desc'
            )
        ));

        if($this->limit)
            $dataProvider->setPagination(false);

        return $dataProvider;
    }

    public function behaviors()
    {
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date', 'modify')
            ),
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'news',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 120, 'height' => 120),
                        'medium' => array('width' => 220, 'height' => 220),
                    ),
                ),
            ),
        );
    }

    public function sorted($sort = 'DESC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "date {$sort}",
        ));

        return $this;
    }
    public function alias($alias = '')
    {
        if(!empty($alias))
            if($type = NewsType::model()->find("alias='{$alias}'"))
                $this->getDbCriteria()->compare('type',$type->id);

        return $this;
    }

    public function getAuthorName()
    {
        return User::model()->findByPk($this->author);
    }

    public function published() {

        $this->getDbCriteria()->mergeWith(array(
            'condition' => '(state = 1 OR state = 2) AND date <= ' . time(),
        ));

        return $this;
    }
}