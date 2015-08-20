<?php

/**
 * This is the model class for table "video_gallery_videos".
 *
 * The followings are the available columns in table 'video_gallery_videos':
 * @property string $id
 * @property integer $portal_id
 * @property integer $video_gallery_id
 * @property string $title
 * @property string $description
 * @property integer $photo
 * @property string $link
 * @property integer $mp4
 * @property integer $ogv
 * @property integer $webm
 * @property integer $date
 * @property integer $state
 */
class VideoGalleryVideos extends BaseActiveRecord
{
    public $prevVideo = null;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'video_gallery_videos';
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
            array('photo, mp4, ogv, webm, date, state', 'numerical', 'integerOnly' => TRUE),
            array('title, link', 'length', 'max' => 255),
            array('description,video_gallery_id', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, description, photo, link, mp4, ogv, webm, date, state', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'photo' => 'Фото для видео',
            'link' => 'Ссылка на youtube',
            'mp4' => 'Файл с видео',
            'ogv' => 'Ogv',
            'webm' => 'Webm',
            'date' => 'Дата',
            'state' => 'Опубликовано',
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
        $criteria->compare('video_gallery_id', $this->video_gallery_id);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('link', $this->link, TRUE);
        $criteria->compare('mp4', $this->mp4);
        $criteria->compare('ogv', $this->ogv);
        $criteria->compare('webm', $this->webm);
        $criteria->compare('date', $this->date);
        $criteria->compare('state', $this->state);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Video the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'DateFieldBehavior',
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'video',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 130, 'height' => 100),
                        'medium' => array('width' => 396, 'height' => 220),
                    ),
                ),
            ),
        );
    }

    public function afterFind()
    {
        parent::afterFind();

        $this->prevVideo = $this->mp4;
    }
}
