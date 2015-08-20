<?php

/**
 * This is the model class for table "people".
 *
 * The followings are the available columns in table 'people':
 * @property integer $id
 * @property integer $portal_id
 * @property integer $type
 * @property integer $photo
 * @property string $full_name
 * @property string $job
 * @property integer $state
 * @property string $contact_address
 * @property string $contact_phone
 * @property string $contact_fax
 * @property string $contact_site
 * @property string $contact_email
 * @property string $main_info
 * @property string $life
 * @property string $social_vk
 * @property string $social_tw
 * @property string $social_fb
 * @property string $date
 * @property integer $office_type_id
 * @property integer $is_deleted
 * @property integer $positionFile
 * @property integer $contact_photo
 * @property string $contact_name
 * @property string $contact_description
 * @property string $url
 */
class People extends BaseActiveRecord
{
    const GOVERNOR= 1;

    const LAW_CHILD = 15;
    const LAW_BUSINESSMAN = 16;
    const LAW_MAN = 17;

    const TYPE_SOVET_FED = 18;
    const DEPARTMENTS = 20;
    const TYPE_DUMA = self::DEPARTMENTS;
    const TYPE_IZBER = 21;
    const TYPE_AUDIT = 22;
    const TYPE_EXPERT = 23;
    const TYPE_KONTROL = 24;
    const TYPE_GOV_FIN = 25;

    const LAW = 30;
    const LAW_AR = self::LAW;
    const LAW_GOR = 31;
    const LAW_PROC = 32;
    const LAW_RAI = 33;
    const LAW_FED = 34;


    const TERR = 40;
    const TERR_ISP = self::TERR;
    const TERR_FED = 41;
    const TERR_GOS = 42;

    const IOGV = 50;
    const IOGV_LEADER = self::IOGV;

    const GOVERNMENT = 60;

    const COMMITTEE = 90;
    const IOGV_COMMITTEE = self::COMMITTEE;
    const IOGV_DEP = 91;
    const IOGV_TERR_O = 92;
    const IOGV_COORD = 93;
    const IOGV_DEP_O = 94;
    const IOGV_PROF = 95;

    const EXPERT = 100;
    const IOGV_EXPERT= self::EXPERT;
    const IOGV_AGRO= 101;
    const IOGV_POLIT= 102;
    const IOGV_INVEST= 103;
    const IOGV_SENS= 104;
    const IOGV_PROM= 105;
    const IOGV_SOCH= 106;
    const IOGV_BILD= 107;
    const IOGV_TERR= 108;
    const IOGV_ECON= 109;

    const POWER = 110;
    const POWER_DEP = self::POWER;
    const POWER_COMMITTEE = 111;
    const POWER_CONTROLS = 112;
    const POWER_GROUP = 113;

    const OTHER_POWER = 120;
    const OTHER_POWER_DEP = self::OTHER_POWER;
    const OTHER_POWER_COMMITTEE = 121;
    const OTHER_POWER_CONTROLS = 122;
    const OTHER_POWER_INSPECTIONS = 123;
    const OTHER_POWER_REPRESENTATIONS = 124;

    /**
     * @var array
     * @TODO уже не нужно все береться из базы
     *
    public static $type_labels = array(
        self::GOVERNOR =>'Губернатор Томской области',
        2=>'Заместитель Губернатора Томской области по инвестиционной политике и имущественным отношениям',
        3=>'Заместитель Губернатора Томской области по научно-образовательному комплексу и инновационной политике',
        4=>'И.о. заместителя губернатора Томской области по промышленной политике',
        5=>'Заместитель Губернатора Томской области по агропромышленной политике и природопользованию',
        6=>'Заместитель Губернатора по строительству и инфраструктуре',
        7=>'Заместитель Губернатора Томской области – начальник Департамента финансов',
        8=>'Заместитель Губернатора Томской области по социальной политике',
        9=>'Заместитель Губернатора Томской области по экономике',
        10=>'Заместитель Губернатора Томской области по внутренней политике и территориальному развитию',
        11=>'Заместитель Губернатора Томской области по вопросам безопасности',
        12=>'Заместитель Губернатора Томской области по взаимодействию с федеральными органами государственной власти',
        13=>'Управляющий делами Администрации Томской области',

        self::LAW_CHILD=>'Уполномоченный по правам ребенка в Томской области',
        self::LAW_BUSINESSMAN=>'Уполномоченный по защите прав предпринимателей',
        self::LAW_MAN=>'Уполномоченный по правам человека в Томской области',
        self::TYPE_SOVET_FED=>'Представитель в Совете Федерации Федерального Собрания Российской Федерации',


        self::TYPE_DUMA => 'Законодательная Дума Томской области',
        self::TYPE_IZBER=>'Избирательная комиссия Томской области',
        self::TYPE_AUDIT => 'Контрольно счетная палата',

        self::TYPE_EXPERT=>'Департамент экспертно-аналитической работы Администрации Томской области',
        self::TYPE_KONTROL=>'Контрольно-ревизионное управление',
        self::TYPE_GOV_FIN=>'Комитет государственного финансового контроля Томской области',

       // self::LAW => 'Судебная власть',
        self::LAW_AR => 'Арбитражный суд',
        self::LAW_GOR =>'Гарнизонный военный суд',
        self::LAW_PROC =>'Прокуратура',
        self::LAW_RAI =>'Районные и городские суды',
        self::LAW_FED =>'Суды субъектов федерации',



       // self::TERR => 'Территориальные органы федеральных органов власти',
        self::TERR_ISP => 'Орган исполнительной власти субъекта федерации',
        self::TERR_FED =>'Территориальное управление федерального органа власти',
        self::TERR_GOS =>'Федеральное государственное учреждение',

        self::IOGV => 'Руководство',

        self::IOGV_COMMITTEE => 'Комитет',
        self::IOGV_DEP => 'Отдел',
        self::IOGV_TERR_O => 'Территориальный орган власти',
        self::IOGV_COORD => 'Координационный, совещательный орган',
        self::IOGV_DEP_O => 'Подведомственные организации',
        self::IOGV_PROF => 'Профильные организации',

        self::IOGV_EXPERT => 'Руководство',
        self::IOGV_AGRO => 'По агропромышленной политике и природопользованию',
        self::IOGV_POLIT => 'По внутренней политике',
        self::IOGV_INVEST => 'По инвестиционной политике и имущественным отношениям',
        self::IOGV_SENS => 'По научно-образовательному комплексу и инновационной политике',
        self::IOGV_PROM => 'По промышленной политике',
        self::IOGV_SOCH => 'По социальной политике',
        self::IOGV_BILD => 'По строительству и инфраструктуре',
        self::IOGV_TERR => 'По территориальному развитию и взаимодействию с органами местного самоуправления',
        self::IOGV_ECON => 'По экономике',


        self::POWER_DEP => 'Департаменты',
        self::POWER_COMMITTEE => 'Комитеты',
        self::POWER_CONTROLS => 'Управления',
        self::POWER_GROUP => 'Отделы',


        self::OTHER_POWER_DEP => 'Департаменты',
        self::OTHER_POWER_COMMITTEE => 'Комитеты',
        self::OTHER_POWER_CONTROLS => 'Управления',
        self::OTHER_POWER_INSPECTIONS => 'Инспекции',
        self::OTHER_POWER_REPRESENTATIONS => 'Представительства',

    );
     * */



    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'people';
    }

    public function behaviors()
    {
        return array(
            'ImageBehavior' => array(
                'class' => 'ImageBehavior',
                'module' => 'people',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small' => array('width' => 200, 'height' => 200),
                    ),
                    array(
                        'field' => 'contact_photo',
                        'small' => array('width' => 200, 'height' => 200),
                    ),
                ),
            ),
            'DateFieldBehavior' => array(
                'class' => 'DateFieldBehavior'
            )
        );
    }
//**
    public static function getTypeLabels($key = 0)
    {
        static $return = null;
        if ($return === null)
            $return = CHtml::listData(PeopleGroup::model()->findAll(array('order'=>'sort asc,id asc')),'id','title');

        return empty($key) ? $return : @$return[$key];
    }


    public static function getTypeGroupLabels($interval=self::GOVERNOR)
    {
        static $all = null;

        if ($all === null)
            foreach(PeopleGroup::model()->findAll(array('order'=>'sort asc,id asc')) as $k=>$v)
                $all[$v->group_id][$v->id]=$v->title;

        return  @$all[$interval];
    }

    public function getTypeLabel()
    {
        return self::getTypeLabels($this->type);
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, type, photo, state, positionFile, office_type_id, is_deleted, positionFile, contact_photo', 'numerical', 'integerOnly'=>true),
            array('full_name, contact_address, contact_phone, contact_fax, contact_site, contact_email, social_vk, social_tw, social_fb, date', 'length', 'max'=>255),
            array('contact_name, contact_description, url', 'length', 'max'=>500),
            array('contact_email', 'email'),
            array('contact_site, social_vk, social_tw, social_fb', 'url', 'validateIDN'=>true, 'defaultScheme' => 'http'),
            array('job, main_info, life, type', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, type, photo, full_name, job, state, contact_address, contact_phone, contact_fax, contact_site, contact_email, main_info, life, social_vk, social_tw, social_fb, date, office_type_id, is_deleted, positionFile, contact_photo, contact_name, contact_description, url', 'safe', 'on'=>'search'),
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
            'file' => array(self::BELONGS_TO, 'File', 'photo'),
            'position' => array(self::BELONGS_TO, 'File', 'positionFile'),
            'staff' => array(self::HAS_MANY, 'PeopleStaff', 'people_id', 'order'=>'staff.main DESC'),
            'unit' => array(self::HAS_MANY, 'PeopleUnit', 'people_id'),
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
            'type' => 'Тип',
            'photo' => 'Фото',
            'full_name' => 'ФИО',
            'job' => 'Должность',
            'state' => 'Опубликовать',
            'contact_address' => 'Адрес',
            'contact_phone' => 'Телефон',
            'contact_fax' => 'Факс',
            'contact_site' => 'Сайт',
            'contact_email' => 'E-mail',
            'main_info' => 'Общая информация',
            'life' => 'Биография',
            'social_vk' => 'Ссылка vkontakte',
            'social_tw' => 'Ссылка twitter',
            'social_fb' => 'Ссылка facebook',
            'date' => 'Date',
            'office_type_id' => 'Office Type',
            'is_deleted' => 'Is Deleted',
            'positionFile' => 'Положение о заместителе',
            'contact_photo' => 'Фото',
            'contact_name' => 'Наименование',
            'contact_description' => 'Описание',
            'url' => 'Url',
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
    public function search($type = 0)
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('portal_id', $this->portal_id);

        if(!empty($type) and empty( $this->type)) {
            $ids = self::getTypeGroupLabels($type);
            $criteria->compare('type',array_keys($ids));
            $pagination = array('pageSize'=>10);
        } else {
            $criteria->compare('type', $this->type);
            $pagination = false;
        }

        $criteria->compare('photo', $this->photo);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('job', $this->job, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('contact_address', $this->contact_address, true);
        $criteria->compare('contact_phone', $this->contact_phone, true);
        $criteria->compare('contact_fax', $this->contact_fax, true);
        $criteria->compare('contact_site', $this->contact_site, true);
        $criteria->compare('contact_email', $this->contact_email, true);
        $criteria->compare('main_info', $this->main_info, true);
        $criteria->compare('life', $this->life, true);
        $criteria->compare('social_vk', $this->social_vk, true);
        $criteria->compare('social_tw', $this->social_tw, true);
        $criteria->compare('social_fb', $this->social_fb, true);
        $criteria->compare('date', $this->date, true);
        $criteria->compare('is_deleted',$this->is_deleted);
        $criteria->compare('positionFile',$this->positionFile);
        $criteria->compare('contact_photo',$this->contact_photo);
        $criteria->compare('contact_name',$this->contact_name,true);
        $criteria->compare('contact_description',$this->contact_description,true);
        $criteria->compare('url',$this->url,true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination'=>$pagination,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return People the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function sorted($sort = 'ASC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "t.type ASC, t.order ASC",
        ));

        return $this;
    }
    protected function beforeFind()
    {
        parent::beforeFind();
        $this->sorted();
    }
}
