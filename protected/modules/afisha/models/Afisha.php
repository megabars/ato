<?php

/**
 * This is the model class for table "afisha".
 *
 * The followings are the available columns in table 'afisha':
 * @property int $id
 * @property string $org
 * @property string $title
 * @property string $place
 * @property integer $duration
 * @property integer $photo
 * @property integer $date
 * @property integer $state
 * @property integer $state_date
 * @property string $preview
 * @property string $description
 * @property string $organizer
 * @property string $longitude
 * @property string $latitude
 * @property string $participant
 */
class Afisha extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'afisha';
    }

    public $pageSIze = 10;

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, title, organizer', 'required'),
            array('portal_id, duration, photo, date, state, state_date', 'numerical', 'integerOnly' => TRUE),
            array('title, organizer, floor', 'length', 'max' => 255),
            array('place', 'length', 'max' => 500),
            array('preview, description, pageSIze', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, place, duration, photo, date, state, state_date, preview, description, organizer, longitude, latitude, participant', 'safe'),
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
            'portal_id' => 'Портал',
            'title' => 'Название',
            'place' => 'Место проведения',
            'duration' => 'Дата и время окончания',
            'photo' => 'Фото',
            'date' => 'Дата и время начала',
            'state' => 'Опубликовано',
            'state_date' => 'Дата публикации',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'organizer' => 'Организатор',
            'longitude' => 'Долгота',
            'latitude' => 'Широта',
            'participant' => 'Количество участников',
            'floor' => 'Этаж, номер кабинета'
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
        $criteria->compare('place', $this->place, TRUE);
        $criteria->compare('duration', $this->duration);
        $criteria->compare('photo', $this->photo);
        $criteria->compare('date', $this->date);
        $criteria->compare('state', $this->state);
        $criteria->compare('state_date', $this->state_date);
        $criteria->compare('preview', $this->preview, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('organizer', $this->organizer, TRUE);
        $criteria->compare('longitude', $this->longitude, TRUE);
        $criteria->compare('latitude', $this->latitude, TRUE);
        $criteria->compare('participant', $this->latitude, TRUE);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => $this->pageSIze,
            ),
            'sort'=>array('defaultOrder'=>'id asc')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Afisha the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function published()
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 'state = 1 AND state_date <= ' . time(),
        ));

        return $this;
    }

    public function setPageSize($pageSIze)
    {
        $this->pageSIze = $pageSIze;
    }

    public function behaviors()
    {
        return array(
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'afisha',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 120, 'height' => 120),
                        'medium' => array('width' => 470, 'height' => 308),
                    ),
                ),
            ),
        );
    }
    public function beforeValidate()
    {
        if (!parent::beforeValidate())
            return false;
        if(empty($this->duration))
            $this->duration = 0;

        return true;

    }

    protected function beforeSave()
    {
        parent::beforeSave();

        if (!empty($this->place) && (empty($this->longitude) && empty($this->latitude)))
        {
            if(@$response = file_get_contents("http://geocode-maps.yandex.ru/1.x/?geocode=Томская область,%20".urlencode(trim($this->place))."&ll=84.979903%2C56.506980&spn=1.084900%2C0.331852&results=1&format=json"))
            {
                $json = json_decode($response);
                $coords = @$json->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;


                if (isset($coords))
                {
                    $coordinates = explode(' ', $coords);

                    $this->longitude = @$coordinates[0];
                    $this->latitude = @$coordinates[1];
                }
            }
        }

        return TRUE;
    }

//    protected function beforeSave()
//    {
//        parent::beforeSave();
//
//        if ($this->place && (empty($this->longitude) || empty($this->latitude)))
//        {
//            $url = "http://geocode-maps.yandex.ru/1.x/?geocode=Томская область,%20".urlencode(trim($this->place))."&ll=84.979903%2C56.506980&spn=1.084900%2C0.331852&results=1&format=json";
//
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $url);
//            curl_setopt($ch, CURLOPT_HEADER, false);
//            curl_setopt($ch, CURLOPT_POST, false);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch, CURLOPT_PROXY, 'proxy');
//            curl_setopt($ch, CURLOPT_PROXYPORT, '8080');
//            curl_setopt($ch, CURLOPT_PROXYTYPE, 'HTTP');
//            curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'rrnasibullin:Ggf8vbf1');
//            $response = curl_exec($ch);
//            curl_close($ch);
//
//            $json = json_decode($response);
//            $coords = @$json->response->GeoObjectCollection->featureMember[0]->GeoObject->Point->pos;
//
//
//            if (isset($coords))
//            {
//                $coordinates = explode(' ', $coords);
//
//                $this->longitude = @$coordinates[0];
//                $this->latitude = @$coordinates[1];
//            }
//        }
//
//        return TRUE;
//    }
}
