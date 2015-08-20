<?php

/**
 * This is the model class for table "opendata".
 *
 * The followings are the available columns in table 'opendata':
 * @property string $id
 * @property string $identifier
 * @property string $title
 * @property string $description
 * @property string $owner
 * @property string $responsible
 * @property string $phone
 * @property string $email
 * @property string $link
 * @property string $format
 * @property string $structure
 * @property integer $date_init
 * @property integer $date_last_change
 * @property integer $last_content
 * @property integer $date_actual
 * @property string $link_version
 * @property string $keyword
 * @property string $link_version_struct
 * @property string $version
 * @property integer $portal_id
 * @property integer $category
 * @property integer $file
 * @property integer $period
 * @property integer $structure_file
 *
 * @property OpendataVersion[] $versions
 */
class Opendata extends BaseActiveRecord
{
    public $category_list = array();

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'opendata';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, file', 'required'),
            array('date_init, date_last_change, date_actual, portal_id', 'numerical', 'integerOnly' => TRUE),
            array('identifier, owner, responsible, phone, email, link, format, link_version, link_version_struct, version, period, last_content', 'length', 'max' => 255),
            array('title, description, structure, keyword, structure_file, category', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, identifier, title, description, owner, responsible, phone, email, link, format, structure, date_init, date_last_change, last_content, date_actual, link_version, keyword, link_version_struct, version, portal_id, category, file, period, structure_file', 'safe', 'on' => 'search'),
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
            'categories' => array(self::HAS_MANY, 'OpendataCategories', 'opendata_id'),
            'versions' => array(self::HAS_MANY, 'OpendataVersion', 'opendata_id', 'limit' => 10, 'order' => 'id DESC'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'identifier' => 'Идентификационный номер',
            'title' => 'Наименование набора открытых данных',
            'description' => 'Описание набора открытых данных',
            'owner' => 'Владелец набора открытых данных',
            'responsible' => 'Ответственное лицо',
            'phone' => 'Телефон ответственного лица',
            'email' => 'Адрес электронной почты ответственного лица',
            'link' => 'Гиперссылка (URL) на открытые данные',
            'format' => 'Формат набора открытых данных',
            'structure' => 'Описание структуры набора открытых данных',
            'date_init' => 'Дата первой публикации набора открытых данных',
            'date_last_change' => 'Дата последнего внесения изменений',
            'last_content' => 'Содержание последнего изменения ',
            'date_actual' => 'Дата актуальности набора данных',
            'link_version' => 'Гиперссылки (URL) на версии открытых данных ',
            'keyword' => 'Ключевые слова, соответствующие содержанию набора данных',
            'link_version_struct' => 'Гиперссылки (URL) на версии структуры набора данных ',
            'version' => 'Версия методических рекомендаций',
            'portal_id' => 'Орган власти',
            'category' => 'Категория',
            'file' => 'Файл открытых данных',
            'period' => 'Периодичность',
            'structure_file' => 'Файл структуры открытых данных',
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
        $criteria->compare('identifier', $this->identifier, TRUE);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('description', $this->description, TRUE);
        $criteria->compare('owner', $this->owner, TRUE);
        $criteria->compare('responsible', $this->responsible, TRUE);
        $criteria->compare('phone', $this->phone, TRUE);
        $criteria->compare('email', $this->email, TRUE);
        $criteria->compare('link', $this->link, TRUE);
        $criteria->compare('format', $this->format, TRUE);
        $criteria->compare('structure', $this->structure, TRUE);
        $criteria->compare('date_init', $this->date_init);
        $criteria->compare('date_last_change', $this->date_last_change);
        $criteria->compare('last_content', $this->last_content);
        $criteria->compare('date_actual', $this->date_actual);
        $criteria->compare('link_version', $this->link_version, TRUE);
        $criteria->compare('keyword', $this->keyword, TRUE);
        $criteria->compare('link_version_struct', $this->link_version_struct, TRUE);
        $criteria->compare('version', $this->version, TRUE);
//        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('category', $this->category);
        $criteria->compare('file', $this->file);
        $criteria->compare('period', $this->period);
        $criteria->compare('structure_file', $this->structure_file);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Opendata the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function afterFind()
    {
        $this->category_list = $this->categories;

        return parent::afterFind();
    }

    /**
     * Сохраняем поле "владелец данных" согласно наименованию портала
     * @return bool
     */
    public function beforeSave()
    {
        if ($portal = Portal::model()->findByPk($this->portal_id))
            $this->owner = $portal->title;

        return parent::beforeSave();
    }

    /**
     * Получение последнего актуального файла набора данных
     * @return array|int|mixed|null
     */
    public function getLatestVersionFile()
    {
//        if (count($this->versions))
//        {
//            $criteria = new CDbCriteria();
//            $criteria->addCondition("opendata_id = {$this->id}");
//            $criteria->order = 'date DESC';
//
//            if ($latestVersion = OpendataVersion::model()->find($criteria))
//            {
//                return $latestVersion->file;
//            }
//        }

        return $this->file;
    }

    /**
     * Получение списка организаций, подавших данные
     * @return string
     */
    static public function getOrganizationCount()
    {
        $criteria = new CDbCriteria();
        $criteria->select = 'portal_id';
        $criteria->group = 'portal_id';

        return self::model()->count($criteria);
    }

    /**
     * Получение количества наборов по portal_id
     * @param $orgId
     * @return string
     */
    static public function getCountByOrganizationId($orgId)
    {
        return self::model()->countByAttributes(array('portal_id' => $orgId));
    }

    /**
     * Получение процента заполнености паспортов в ОИГВ
     * @param $portal_id
     * @return float|int
     */
    static public function getPortalPassportPercent($portal_id)
    {
        $percent = 0;

        $count = 0;

        foreach (Opendata::model()->findAllByAttributes(array('portal_id' => $portal_id)) as $item)
        {
            $percent += $item->passportPercent();
            $count++;
        }

        return $count ? round($percent / $count, 2) : 0;
    }

    /**
     * Получение процента заполнености паспорта
     * @return float
     */
    public function passportPercent()
    {
        $fields = array('identifier', 'title', 'description', 'owner', 'responsible', 'phone', 'email',
            'link', 'format', 'structure', 'date_init', 'date_last_change', 'last_content', 'date_actual',
            'link_version', 'keyword', 'link_version_struct', 'version', 'category', 'period');

        $count = 0;

        foreach ($fields as $field)
        {
            if (!empty($this->$field))
                $count++;
        }

        return ($count / 20) * 100;
    }

    public function defaultScope()
    {
        // Выбираем не удаленные
        if ($this->hasAttribute('is_deleted'))
        {
            $condition = "{$this->getTableAlias(TRUE, FALSE)}.is_deleted=" . self::STATUS_DEFAULT;

            $cArr['condition'] = (isset($cArr['condition'])) ? $cArr['condition'] . " AND " . $condition : $condition;

            return $cArr;
        }

        return array();
    }
}
