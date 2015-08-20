<?php

/**
 * This is the model class for table "audio".
 *
 * The followings are the available columns in table 'audio':
 * @property string $id
 * @property string $title
 * @property string $description
 * @property integer $wav
 * @property integer $mp3
 * @property integer $portal_id
 * @property integer $file
 */
class Audio extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'audio';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, portal_id, file', 'required'),
            array('wav, mp3, portal_id, file', 'numerical', 'integerOnly' => TRUE),
            array('title', 'length', 'max' => 255),
            array('description', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, description, wav, mp3, portal_id, file', 'safe', 'on' => 'search'),
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
            'description' => 'Описание',
            'wav' => 'Wav',
            'mp3' => 'Mp3',
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
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('wav', $this->wav);
        $criteria->compare('mp3', $this->mp3);
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('file', $this->file);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Audio the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeSave()
    {
        if (parent::beforeSave() && $file = File::model()->findByPk($this->file))
        {
            $streamer = new AudioStreamer($file, 'C:\ffmpeg\bin\ffmpeg.exe');

            $this->mp3 = $streamer->saveFile('mp3');
            $this->wav = $streamer->saveFile('wav');
            $streamer->saveFile('mp4');

            return TRUE;
        }

        return FALSE;
    }
}
