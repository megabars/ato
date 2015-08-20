<?php

/**
 * This is the model class for table "documents".
 *
 * The followings are the available columns in table 'documents':
 * @property integer $id
 * @property integer $folder_id
 * @property string $title
 * @property string $preview
 * @property integer $ordi
 * @property string $note
 * @property integer $date
 * @property string $public
 * @property string $number
 * @property integer $file
 * @property integer $pdf
 * @property integer $doc
 * @property integer $zip
 * @property integer $change_date
 * @property string $description
 * @property integer $executive_id

 *
 * The followings are the available model relations:
 * @property DocumentsFolder $folder
 */
class Documents extends BaseActiveRecord
{

    public $dateStart = null;
    public $dateEnd = null;
    public $pageTitle = null;
    public $fileDate = null;
    public $userName = null;
    public $searchText = null;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'documents';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('folder_id, title', 'required'),
            array('executive_id, number', 'required', 'on'=>'npa'),
            array('folder_id, ordi, date, file, pdf, doc, zip, change_date, executive_id', 'numerical', 'integerOnly' => true),
            array('number', 'length', 'max' => 255),
            array('note, public', 'length', 'max' => 500),
            array('date_public, date_real, preview, date, change_date, preview, folder_id, public, executive_id, description, dateStart, dateEnd, searchText', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, folder_id, preview, ordi, date, number, note, public, pdf, doc, zip, change_date, description, executive_id, folder, dateStart, dateEnd, pageTitle, fileDate, userName', 'safe', 'on' => 'search'),
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
            'folder' => array(self::BELONGS_TO, 'DocumentsFolder', 'folder_id'),
            'executive' => array(self::BELONGS_TO, 'Executive', 'executive_id'),
            'originFile' => array(self::BELONGS_TO, 'File', 'file'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'folder_id' => 'Папка',
            'title' => 'Заголовок',
            'preview' => 'Описание',
            'ordi' => 'Сортировка',
            'note' => 'Примечание',
            'date' => 'Дата размещения',
            'public' => 'Где и когда опубликовано',
            'number' => 'Номер документа',
            'file' => 'Файл',
            'pdf' => 'PDF файл',
            'doc' => 'Текстовый файл (doc, docx, xls, xlxs)',
            'zip' => 'Архивный файл (zip, zipx, rar, 7z, arj)',
            'change_date' => 'Дата изменения',
            'description' => 'Текст документа',
            'executive_id' => 'Орган исполнительной власти',
            'date_real' => 'Дата утверждения',
            'date_public' => 'Дата публикации',
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

        $criteria->with = array('folder');

        $criteria->compare('id', $this->id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('preview', $this->preview, true);
        $criteria->compare('ordi', $this->ordi);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('date', $this->date);
        $criteria->compare('public', $this->public, true);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('file', $this->file);
        $criteria->compare('pdf', $this->pdf);
        $criteria->compare('doc', $this->doc);
        $criteria->compare('zip', $this->zip);
        $criteria->compare('change_date', $this->change_date);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('executive_id', $this->executive_id);
        $criteria->compare('folder_id', $this->folder_id);

        if (!empty($this->fileDate)) {
            $criteria->with = ($criteria->with==null)? array('originFile'):array_merge($criteria->with, array('originFile'));
            $criteria->compare('"originFile"."date"', '>='.strtotime($this->fileDate));
            $criteria->compare('"originFile"."date"', '<='.(strtotime($this->fileDate)+86400));
        }

        if (!empty($this->userName)) {
            $criteria->with = ($criteria->with==null)? array('originFile'):array_merge($criteria->with, array('originFile'));
            $criteria->compare('"originFile"."user_id"', $this->userName);
        }

        if (!empty($this->pageTitle)) {
            $criteria->with = ($criteria->with==null)? array('folder.group'):array_merge($criteria->with, array('folder.group'));
            $criteria->compare('"group"."id"', $this->pageTitle);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function searchNpa()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->addSearchCondition('LOWER(t.title)', mb_convert_case($this->title, MB_CASE_LOWER, 'utf8'), true);
        $criteria->addSearchCondition('LOWER(t.preview)', mb_convert_case($this->preview, MB_CASE_LOWER, 'utf8'), true);
        $criteria->compare('ordi', $this->ordi);
        $criteria->addSearchCondition('LOWER(t.note)', mb_convert_case($this->note, MB_CASE_LOWER, 'utf8'), true);
        $criteria->compare('date', $this->date);
        $criteria->addSearchCondition('LOWER(t.public)', mb_convert_case($this->public, MB_CASE_LOWER, 'utf8'), true);
        $criteria->addSearchCondition('LOWER(t.number)', mb_convert_case($this->number, MB_CASE_LOWER, 'utf8'), true);
        $criteria->compare('file', $this->file);
        $criteria->compare('pdf', $this->pdf);
        $criteria->compare('doc', $this->doc);
        $criteria->compare('zip', $this->zip);
        $criteria->compare('change_date', $this->change_date);
        $criteria->addSearchCondition('LOWER(t.description)', mb_convert_case($this->description, MB_CASE_LOWER, 'utf8'), true);
        $criteria->order = 'date asc';

        if (is_array($this->executive_id))
            $criteria->addInCondition('executive_id', $this->executive_id);
        else
            $criteria->compare('executive_id', $this->executive_id);

        if (is_array($this->folder_id))
            $criteria->addInCondition('folder_id', $this->folder_id);
        else
            $criteria->compare('folder_id', $this->folder_id);

        if (isset($this->dateStart))
            $criteria->compare('date', '>='.strtotime($this->dateStart));

        if (isset($this->dateEnd))
            $criteria->compare('date', '<='.strtotime($this->dateEnd));

        $criteria->with = ($criteria->with==null)? array('folder.group'):array_merge($criteria->with, array('folder.group'));
        $criteria->compare('"group"."alias"', 'main');

        if(!empty($this->searchText)) {
            $searchTextCriteria = new CDbCriteria;
            $this->searchText = mb_convert_case($this->searchText, MB_CASE_LOWER, 'utf8');
            $searchTextCriteria->addSearchCondition('LOWER(t.title)', $this->searchText, true, 'OR');
            $searchTextCriteria->addSearchCondition('LOWER(t.preview)', $this->searchText, true, 'OR');
            $searchTextCriteria->addSearchCondition('LOWER(t.note)', $this->searchText, true, 'OR');
            $searchTextCriteria->addSearchCondition('LOWER(t.number)', $this->searchText, true, 'OR');
            $searchTextCriteria->addSearchCondition('LOWER(t.public)', $this->searchText, true, 'OR');
            $searchTextCriteria->addSearchCondition('LOWER(t.description)', $this->searchText, true, 'OR');
            $criteria->mergeWith($searchTextCriteria);
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Documents the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function published()
    {
        $this->getDbCriteria()->mergeWith(array(
            'with' => 'folder',
            'condition' => 'folder.state = 1',
        ));

        return $this;
    }

    protected function beforeSave()
    {
        if($this->isNewRecord)
            $this->date = time();

        $this->change_date = time();

        return parent::beforeSave();
    }
}
