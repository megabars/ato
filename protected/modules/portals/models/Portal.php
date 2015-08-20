<?php

/**
 * This is the model class for table "portal".
 *
 * The followings are the available columns in table 'portal':
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $theme
 * @property string $code
 */
class Portal extends BaseActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Portal the static model class
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
        return 'portal';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, alias', 'required'),
            array('alias', 'unique'),
//            array('alias', 'url', 'pattern' => '/^(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)/i'),
            array('alias', 'match', 'pattern' => '/^[0-9A-Za-z-\/\.]+$/u', 'message' => 'В этом поле резрешено использование только латинских букв и тире'),
            array('title, alias', 'length', 'max' => 255),
            array('code', 'length', 'max' => 100),
            array('theme', 'length', 'max' => 25),

            array('fileId', 'safe'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, alias', 'safe', 'on' => 'search'),
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
            'alias' => 'URL',
            'theme' => 'Тема оформления',
            'code' => 'Код департамента',
            'fileId' => 'CSV c основным меню создаваемого портала'
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

        $criteria->addSearchCondition('LOWER(t.title)', mb_convert_case($this->title, MB_CASE_LOWER, 'utf8'), true);
        $criteria->addSearchCondition('LOWER(t.alias)', mb_convert_case($this->alias, MB_CASE_LOWER, 'utf8'), true);

//        $criteria->compare('title', strtolower($this->title), true);
//        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('code', $this->code, true);
        $criteria->addCondition('id != 1');

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeDelete()
    {
        parent::beforeDelete();

        $models = array(
            'NavMenu', 'StaticPage', 'News', 'File', 'Vote', 'Afisha', 'Audio', 'PhotoGallery',
        );

        foreach ($models as $name) {
            $name::model()->deleteAllByAttributes(array('portal_id' => $this->id));
        }

        return true;
    }


    public function afterSave()
    {
        parent::afterSave();

        /** не убирать! */
        if (!$this->isNewRecord) {
            return true;
        }

        if ($this->theme == 'expert')
            $this->saveExpertServices();
        else
            $this->saveServices();

        $this->saveRightMenu();

        $this->saveMapMenu();

        // создадим upload folder
        $portalFolder = Yii::app()->getBasePath() . '/../' . BaseActiveRecord::getUploadFolder(false) . $this->id;
        if (!is_dir($portalFolder)) {
            @mkdir($portalFolder, '0755');
            @mkdir($portalFolder . '/thumbs', '0755');
        }

        $file = new File();
        $file->attributes = array(
            'portal_id' => $this->id,
            'origin_name' => 'initial_menu.csv',
            'name' => 'initial_menu.csv',
            'size' => 5,
            'ext' => 'csv',
            'date' => time(),
        );

        $from = Yii::app()->getBasePath() . '/data/' . $this->theme . '_init.csv';
        $copy = @copy($from, $portalFolder . '/initial_menu.csv');

        if ($file->save()) {
            $menu = new NavMenu();

            $menu->attributes = array(
                'name' => 'Основное',
                'alias' => 'main_menu',
                'published' => 1,
                'fileId' => $file->id,
                'portal_id' => $this->id
            );

            // создание элементов внутри модели спратано
            $menu->save();
        }


    }

    /**
     * Порталы у которых есть хотя бы один набор открытых данных
     * @return $this
     */
    public function hasOpendata()
    {
        $this->getDbCriteria()->mergeWith(array(
            'distinct' => true,
            'join' => 'INNER JOIN opendata AS od ON od.portal_id = t.id',
        ));

        return $this;
    }

    public function createAbsoluteAddress($address)
    {
        return "http://{$this->alias}{$address}";
    }

    /**
     * У экспертных советов свое нижнее меню
     */
    public function saveExpertServices(){

        $navMenuModel = new NavMenu();
        $navMenuModel->portal_id = $this->id;
        $navMenuModel->alias = 'services';
        $navMenuModel->is_deleted = 0;
        $navMenuModel->published = 1;

        // Сохраняем 8 основных сервисов
        if (!$navMenuModel->save())
            throw new CHttpException(500, 'Cant save services menu '.print_r($navMenuModel->getErrors()));

        $possibleNames = array(
            'База данных экспертов'          => '/experts/front/index',
            'Экспертное обсуждение'          => null,
            'Задать вопрос'                      => '/feedback/front/index',
        );

        foreach ($possibleNames as $navItemTitle => $navItemUrl)
        {

            $urlManager = new UrlManager();

            if ($navItemUrl === null)
                $urlManager->url = str_replace(' ', '-', Transliterate::text($navItemTitle));
            else
                $urlManager->url = $navItemUrl;

            $urlManager->portal_id = $this->id;
            $urlManager->title = $navItemTitle;

            // Если сохранился новый url
            if ($urlManager->save())
            {
                $navMenuItem = new NavItems();
                $navMenuItem->title = $navItemTitle;
                $navMenuItem->parent_id = 0;
                $navMenuItem->state = 1;
                $navMenuItem->menuId = $navMenuModel->id;
                $navMenuItem->url_id = $urlManager->id;
                $navMenuItem->is_deleted = 0;
                $navMenuItem->is_link = 1;

                if (!$navMenuItem->save()){
                    Yii::log('Cant save services menu item. Error is: '.print_r($navMenuItem, true), CLogger::LEVEL_ERROR);
                }
            }
        }


    }

    public function saveServices()
    {
        $navMenuModel = new NavMenu();
        $navMenuModel->portal_id = $this->id;
        $navMenuModel->alias = 'services';
        $navMenuModel->is_deleted = 0;

        // Сохраняем 8 основных сервисов
        if ($navMenuModel->save())
            $this->saveServiceMenu($navMenuModel);
    }

    /**
     * Боковое меню на главной странице субпортала, по умолчанию не опубликовано
     */
    public function saveRightMenu()
    {
        $menu = new NavMenu();
        $menu->portal_id = $this->id;
        $menu->alias = 'right_menu';
        $menu->is_deleted = 0;
        $menu->published = 0;

        if ($menu->save())
        {
            $items = array(
                'tariff-map' => 'Карта тарифов',
                "eias" => 'ЕИАС',
                "show-information" => 'Раскрытие информации',
                "communal-serv" => 'Коммунальные услуги',
                "energy-saving" => 'Энергосбережение'
            );

            foreach ($items as $url => $name)
            {
                $urlModel = new UrlManager();
                $urlModel->portal_id = $this->id;
                $urlModel->url = $url;
                $urlModel->title = $name;

                if ($urlModel->save())
                {
                    $nav = new NavItems();

                    $nav->attributes = array(
                        'title' => $name,
                        'url_id' => $urlModel->id,
                        'state' => 1,
                        'menuId' => $menu->id,
                        'parent_id' => 0,
                        'is_link' => 1,
                        'is_deleted' => 0,
                    );

                    $nav->save();
                }
            }
        }
    }

    /**
     * Сохранение 8 основных пунктов меню для сервисов (например Открытые данные, Кадровая политика и т.д.)
     * @param $navMenuModel
     */
    public function saveServiceMenu($navMenuModel)
    {
        $possibleNames = array(
            'Обращения граждан'          => 4,
            'Кадровая политика'          => 5,
            'Противодействие коррупции'  => 6,
            'Открытые данные'            => 7,
            'Информационные системы'     => 8,
            'Проверки'                   => 9,
            'Статистика'                 => 10,
            'Аукционы и конкурсы'        => 11,
        );

        foreach ($possibleNames as $navItemTitle => $navItemValue)
        {
            $urlManager = new UrlManager();
            $urlManager->url = str_replace(' ', '-', Transliterate::text($navItemTitle));
            $urlManager->portal_id = $this->id;
            $urlManager->title = $navItemTitle;

            // Если сохранился новый url
            if ($urlManager->save())
            {
                $navMenuItem = new NavItems();
                $navMenuItem->title = $navItemTitle;
                $navMenuItem->parent_id = 0;
                $navMenuItem->state = 1;
                $navMenuItem->menuId = $navMenuModel->id;
                $navMenuItem->url_id = $urlManager->id;
                $navMenuItem->is_deleted = 0;
                $navMenuItem->is_link = 1;

                // Если сохранился элемент меню, запускаем транзакцию
                if ($navMenuItem->save() && $navItemValue == 5)
                {
                    $this->saveStaff($navMenuItem);
                }
            }
        }
    }

    /**
     * Сохранение меню для сервиса "Кадровая политика"
     * @param $parentItem
     */
    public function saveStaff($parentItem)
    {
        $items = array(
            'Государственная гражданская служба' => array(
                'Кадровый резерв' => '',
                'Список лиц' => '',
            ),
            'Конкурсы' => array(
                'Текущие конкурсы' => '',
                'Итоги' => '',
            ),
            'Аттестации' => '',
            'Комиссия' => '',
            'Нормативные документы' => '',
        );

        foreach ($items as $item => $value)
        {
            $urlModel = new UrlManager();
            $urlModel->portal_id = $this->id;
            $urlModel->url = str_replace(' ', '-', Transliterate::text($item));
            $urlModel->title = $item;

            if ($urlModel->save())
            {
                $mainModel = new NavItems();

                $mainModel->attributes = array(
                    'title' => $item,
                    'parent_id' => $parentItem->id,
                    'menuId' => $parentItem->menuId,
                    'url_id' => $urlModel->id,
                    'state' => 1,
                    'is_link' => 1,
                    'is_deleted' => 0,
                );

                if ($mainModel->save() && is_array($value))
                {
                    foreach ($value as $secondItem => $secondItemValue)
                    {
                        $secondUrlModel = new UrlManager();
                        $secondUrlModel->portal_id = $this->id;
                        $secondUrlModel->url = str_replace(' ', '-', Transliterate::text($secondItem));
                        $secondUrlModel->title = $secondItem;

                        if ($secondUrlModel->save())
                        {
                            $secondModel = new NavItems();

                            $secondModel->attributes = array(
                                'title' => $secondItem,
                                'parent_id' => $mainModel->id,
                                'menuId' => $parentItem->menuId,
                                'url_id' => $secondUrlModel->id,
                                'state' => 1,
                                'is_link' => 1,
                                'is_deleted' => 0,
                            );

                            $secondModel->save();
                        }
                    }
                }
            }
        }
    }

    public function saveMapMenu()
    {
        $menu = new NavMenu();
        $menu->portal_id = $this->id;
        $menu->alias = 'map_menu';
        $menu->is_deleted = 0;
        $menu->published = 1;

        // Сохраняем меню карты для данного портала
        if ($menu->save())
        {
            // Находим меню карты на основном портале
            if ($mainPortalMenu = NavMenu::model()->findByAttributes(array('portal_id' => 1, 'alias' => 'map_menu')))
            {
                // Копируем все элементы данного меню с основного портала на текущий
                foreach ($mainPortalMenu->navItems as $mainPortalItem)
                {
                    $urlModel = new UrlManager();
                    $urlModel->portal_id = $this->id;
                    $urlModel->url = str_replace(' ', '-', Transliterate::text($mainPortalItem->title));
                    $urlModel->title = $mainPortalItem->title;

                    if ($urlModel->save())
                    {
                        $nav = new NavItems();

                        $nav->attributes = array(
                            'title' => $mainPortalItem->title,
                            'url_id' => $urlModel->id,
                            'state' => 1,
                            'menuId' => $menu->id,
                            'parent_id' => 0,
                            'is_link' => 1,
                            'is_deleted' => 0,
                        );

                        $nav->save();
                    }
                }
            }
        }
    }

    public static function bizzRulesArray()
    {
        $data = array();

        foreach (self::model()->findAll() as $item)
            $data[$item->id] = $item->title;

        return $data;
    }
}