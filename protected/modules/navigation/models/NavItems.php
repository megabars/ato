<?php

/**
 * This is the model class for table "NavItems".
 *
 * The followings are the available columns in table 'NavItems':
 * @property integer $id
 * @property integer $menuId
 * @property string $title
 * @property string $url_id
 * @property integer $parent_id
 * @property integer $ordi
 * @property integer $state
 * @property integer $is_link
 */
class NavItems extends BaseActiveRecord
{
    public $navItemUrl = null;

    /**
     * Построить хлебные крошки по меню
     * @param array $result
     * @return array
     */
    public function getBreadcrumbs($result = array()){
        $result[$this->title] = $this->url;

        if ($this->parent_id !== null) {
            $parentId = $this->parent_id;
            while  (($parent = self::model()->findByPk($parentId)) !== null) {
                $parent->title = mb_convert_case($parent->title, MB_CASE_TITLE, 'UTF-8');;

                if ($parent->is_link == 1)
                    $result[$parent->title] = '/' . $parent->url;
                else
                    array_push($result, $parent->title);

                $parentId = $parent->parent_id;

                if ($parent->parent_id == 0)
                    break;
            }
        }
        $result = array_reverse($result);

        // из последнего элемента надо убрать массив со ссылкой
        $keys = array_keys($result);
        $lastKey = end($keys);
        unset($result[$lastKey]);
        array_push($result,$lastKey);

        return $result;
    }

    public function getPortalCriteria(){

        return array(
            'condition' => 'menu.portal_id = :portal_id',
            'with' => 'menu',
            'params' => array('portal_id' => isset(Yii::app()->getController()->portalId) ? Yii::app()->getController()->portalId : 1)
        );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'nav_items';
    }

    /**
     * Для чего нужна была эта функция?
     * @return bool
     */
//    public function beforeValidate(){
//        $url = modelFactory::get('UrlManager', array('id' => (int)$this->url_id));
//
//        if($this->navItemUrl!=null) {
//            $url->url = $this->navItemUrl;
//        }
//
//        if ($url->validate()){
//            return parent::beforeValidate();
//        } else {
//            $this->addError('navItemUrl', $url->getError('url'));
//            return false;
//        }
//    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('menuId, title', 'required'),
            array('navItemUrl', 'required', 'on'=>'in_structure'),

            array('parent_id, ordi, state, menuId', 'numerical', 'integerOnly' => true),
            array('title, photo', 'length', 'max' => 255),

            array('url_id, is_link, navItemUrl', 'safe'),
//            array('url', 'unique', 'on' => 'insert'),

            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, title, url, parent_id, ordi, state', 'safe', 'on' => 'search'),
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
            'menu' => array(self::BELONGS_TO,'NavMenu', 'menuId'),
            'url' => array(self::BELONGS_TO,'UrlManager', 'url_id'),
            'file' => array(self::HAS_ONE, 'File', 'photo')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Заголовок',
            'url_id' => 'Адрес страницы',
            'navItemUrl' => 'Адрес страницы',
            'parent_id' => 'Родительский элемент',
            'ordi' => 'Порядок',
            'state' => 'Опубликовано',
            'menuId' => 'Блок навигации',
            'photo' => 'Фото',
            'is_link' => 'Является ссылкой'

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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('url', $this->url, true);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('ordi', $this->ordi);
        $criteria->compare('state', $this->state);
        $criteria->compare('navItemUrl', $this->navItemUrl);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NavItems the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function behaviors()
    {
        return array(
            'OrderBehavior' => array(
                'class'  => 'OrderBehavior',
            ),
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'navigation',
                'fields' => array(
                    array(
                        'field' => 'photo',
//                        'small'  => array('width' => 120, 'height' => 120),
//                        'medium' => array('width' => 650, 'height' => 405),
                    ),
                ),
            ),
        );
    }

    public function firstLevel()
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => "t.parent_id = 0",
        ));

        return $this;
    }

    public function sorted($sort = 'ASC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "t.ordi {$sort}",
        ));

        return $this;
    }

    public function afterSave(){
        parent::afterSave();

        // если меняем Меню, то во всех дочерних тоже надо поменять
        $children = NavItems::model()->with('url')->findAllByAttributes(array('parent_id'=>$this->id));
        foreach($children as $child) {
            $child->menuId = $this->menuId;
            $child->navItemUrl = @$child->url->url;
            $child->save();
        }

        if (StaticPage::model()->countByAttributes(array('url_id' => $this->url_id)) == 0)
        {
            $page = new StaticPage();
            $page->url_id = $this->url_id;
            $page->title = $this->title;
            $page->state = $this->state;

            if (is_numeric($this->menuId)){
                $menu = NavMenu::model()->resetScope()->findByPk($this->menuId);
                $page->portal_id = @$menu->portal_id;
            }

            $page->date = time();
            $page->type_id = 0;

            $page->save();
        }

        $removedPage = StaticPage::model()->with('url')->removed()->findByAttributes(array('url_id'=>$this->url_id));
        if($removedPage != null && $this->is_deleted == BaseActiveRecord::STATUS_DEFAULT) {
            $removedPage->is_deleted = BaseActiveRecord::STATUS_DEFAULT;
            if (!$removedPage->save())
                throw new CHttpException(500, 'Не удалось восстановить страницу');
        }
    }

    public function afterDelete() {
        parent::afterDelete();

        // удаляем страницу вместе с элементом меню
        StaticPage::model()->deleteAllByAttributes(array('url_id' => $this->url_id));
    }
}
