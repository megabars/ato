<?php

/**
 * This is the model class for table "file".
 *
 * The followings are the available columns in table 'file':
 * @property integer $id
 * @property integer $portal_id
 * @property string $origin_name
 * @property string $name
 * @property integer $size
 * @property string $ext
 * @property integer $date
 * @property integer $user_id
 */
class File extends BaseActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return File the static model class
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
        return 'file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, origin_name, name, size, ext, date', 'required'),
            array('portal_id, size, date, user_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            array('origin_name', 'safe'),
            array('ext', 'length', 'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, portal_id, origin_name, name, size, ext, date', 'safe', 'on' => 'search'),
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
            'portal_id' => 'Portal',
            'origin_name' => 'Origin Name',
            'name' => 'Name',
            'size' => 'Size',
            'ext' => 'Ext',
            'date' => 'Date',
            'user_id' => 'Пользователь',
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
        $criteria->compare('origin_name', $this->origin_name, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('size', $this->size);
        $criteria->compare('ext', $this->ext, true);
        $criteria->compare('date', $this->date);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function isImage(){

        $imageExt = array("jpg", 'jpeg', 'gif', 'png', 'bmp');

        foreach ($imageExt as $ext) {
            $imageExt[] = strtoupper($ext);
            $imageExt[] = ucfirst($ext);
        }

        return in_array($this->ext, $imageExt);
    }

    public function getFilePath($fileId = null)
    {
        $folder = self::$uploadFileFolder;

        if ($fileId === null)
            $fileId = $this->id;

        if ($file = $this->resetScope()->findByPk($fileId))
            return Yii::app()->basePath . "/..{$folder}/{$file->portal_id}/" . $file->name;
    }

//    public function getFileUrl($fileId = null)
//    {
//        if ($fileId === null)
//            $fileId = $this->id;
//
//        if ($file = $this->findByPk($fileId))
//            return "{$this->uploadFilePath}" . $file->name;
//    }
//
//    public function getSize($fileId)
//    {
//        if ($file = $this->findByPk($fileId))
//            return ceil($file->size / 1024);
//    }

    public static function getFileSize($fileId, $unit=null)
    {
        if ($file = self::model()->resetScope()->findByPk($fileId))
        {
            $size = 0;
            switch($unit) {
                case 'Kb' :
                    $size = $file->size/1024;
                    break;
                case 'Mb' :
                    $size = $file->size/(1024*1024);
                    break;
                case 'Gb' :
                    $size = $file->size/(1024*1024*1024);
                    break;
                case 'Tb' :
                    $size = $file->size/(1024*1024*1024*1024);
                    break;
            }

            return ($unit) ? round($size, 2).' '.$unit : $file->size.' b';
        }
        return 0;
    }

    /**
     * Удаляет файл физически при удалении модели
     * @return bool
     */
    public function beforeRealDelete(){
        $path = $this->getFilePath();
        if (!unlink($path))
            Yii::log("Cant phisically remove file! Path:".$path, CLogger::LEVEL_WARNING);
    }


}