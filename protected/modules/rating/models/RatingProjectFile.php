
<?php

/**
 * This is the model class for table "rating_project_file".
 *
 * The followings are the available columns in table 'rating_project_file':
 * @property integer $id
 * @property integer $project_id
 * @property integer $ord
 * @property integer $file
 * @property string $description
 * @property string $title
 */
class RatingProjectFile extends BaseActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'rating_project_file';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('file, title', 'required'),
            array('project_id, ord, file', 'numerical', 'integerOnly'=>true),
            array('title', 'length', 'max'=>500),
            array('description', 'length', 'max'=>1000),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, project_id, ord, file, description', 'safe', 'on'=>'search'),
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
            'project' => array(self::BELONGS_TO, 'RatingDoc', 'project_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Название файла',
            'project_id' => 'Project',
            'ord' => 'Ord',
            'file' => 'File',
            'description' => 'Описание',

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
        $criteria->compare('title',$this->title);
        $criteria->compare('project_id',$this->project_id);
        $criteria->compare('ord',$this->ord);
        $criteria->compare('file',$this->file);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RatingProjectFile the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}