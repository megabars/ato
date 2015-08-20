<?php

/**
 * This is the model class for table "smi".
 *
 * The followings are the available columns in table 'smi':
 * @property integer $id
 * @property integer $portal_id
 * @property integer $date
 * @property integer $photo
 * @property string $title
 * @property string $preview
 * @property string $description
 * @property integer $state
 * @property string $photo_title
 * @property string $author
 * @property string $source
 * @property string $source_link
 * @property integer $url_id
 * @property integer $photo_gallery_id
 * @property integer $video_id
 * @property integer $file_group_id
 * @property integer $links_group_id
 */
class Smi extends BaseActiveRecord
{
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
        parent::afterFind();

        if (Yii::app() instanceof CConsoleApplication) {
            return true;
        }

        if ($this->file_group_id == null
            OR $this->pageFolders === null
            OR $this->pageFolders->isNewRecord) {
            // группа документов
            $folders = new FoldersGroup();
            $folders->alias = 'auto_generated_folder_group_smiId_' . $this->id;
            $folders->save();
            $this->file_group_id = $folders->id;
        }

        if ($this->links_group_id == null
            OR $this->pageLinks === null
            OR $this->pageLinks->isNewRecord) {
            // группа ссылок
            $links = new LinksGroup();
            $links->alias = 'auto_generated_links_group_smiId_' . $this->id;
            $links->save();
            $this->links_group_id = $links->id;
        }

        if ($this->photo_gallery_id == null
            OR $this->pageGallery === null
            OR $this->pageGallery->isNewRecord) {
            // фотогаллерея
            $photo = new PhotoGallery();
            $photo->title = 'auto_generated_gallery_smiId_' . $this->id;
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
        if ($this->url !== null && isset($_POST['UrlManager'])) {
//            $this->refresh();
            $this->url->attributes = $_POST['UrlManager'];
            $this->url->save();
        }

        return parent::afterSave();
    }
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'smi';
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
            array('title, photo_title, author, source, source_link', 'length', 'max' => 255),
            array('preview, description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, date, photo, title, preview, description, state, photo_title, author, source, source_link', 'safe', 'on' => 'search'),
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
            'date' => 'Дата',
            'photo' => 'Фото',
            'title' => 'Заголовок',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'state' => 'Опубликовано',
            'photo_title' => 'Подпись к фото',
            'author' => 'Автор',
            'source' => 'Источник',
            'source_link' => 'Ссылка на источник',
            'social' => 'Поделиться в соц. сетях',
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
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('date', $this->date);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('preview', $this->preview, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('state', $this->state);
        $criteria->compare('photo_title', $this->photo_title, TRUE);
        $criteria->compare('author', $this->author, TRUE);
        $criteria->compare('source', $this->source, TRUE);
        $criteria->compare('source_link', $this->source_link, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Smi the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date')
            ),
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'smi',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 200, 'height' => 200),
                        'medium' => array('width' => 650, 'height' => 405),
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

    public function published() {

        $this->getDbCriteria()->mergeWith(array(
            'condition' => '(state = 1 OR state = 2) AND date <= ' . time(),
        ));

        return $this;
    }

    public function getKeywordsAsLink($url) {
        $keywords = explode(',', $this->url->meta_keywods);
        $keywords_as_link = array();
        foreach($keywords as $keyword)
        {
            $keywords_as_link[] = CHtml::link(trim($keyword), Yii::app()->controller->createUrl($url, array('search' => trim($keyword))));
        }

        return implode(', ', $keywords_as_link);
    }
}
