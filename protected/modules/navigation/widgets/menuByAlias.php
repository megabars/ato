<?php
/**
 * author: Mikhail Matveev
 * Date: 28.11.14 
 */

Yii::import('zii.widgets.CMenu');

class menuByAlias extends CMenu {

    public $activeCssClass = 'current';

    /**
     * Элементы какого меню выводить
     * @var mixed
     */
    public $menu_alias = 'main_menu';

    /**
     * По умолчанию выводим все уровни. Количество уровней указывается начиная с 0
     * @var int
     */
    public $max_levels = false;

    /**
     * По умолчанию стандартный шаблон. Для админки с драгом
     * @var boolean
     */
    public $draggable = false;

    /**
     * Используется, если надо вывести подменю конкретного раздела
     * @var int
     */
    public $parentId = 0;

    public $allowedPages;

    public function init(){

        if ($this->parentId === null)
            $this->parentId = 0;

        $au = UsrAuthAssignment::model()->findByAttributes(array('userid' => (string)Yii::app()->user->id, 'itemname' => 'PortalAdmin'));

        if ($au !== null)
        {
            $data = json_decode($au->data);

            if (!empty($data->portal_id))
            {
                $accessModel = StaticPageAccess::model()->findByAttributes(array('usr_portal_id' => $data->portal_id));
                $this->allowedPages = $accessModel ? explode(',', $accessModel->rule) : array();

                if (Yii::app()->controller->portalId == $data->portal_id)
                    $isAdmin = true;
            }
        }

        if (empty($isAdmin))
            $isAdmin = @User::model()->findByPk(Yii::app()->user->id)->superuser;

        $this->items = $this->getMenuContentItems($this->max_levels, $this->menu_alias, $this->draggable, $this->parentId, 0, $isAdmin);
    }

    public function getMenuContentItems($max_levels, $alias, $draggable, $parentId, $level=0, $isAdmin) {

        $data = array();

        $c = new CDbCriteria();
        $c->addCondition("menu.alias = '{$alias}'");

        if ($parentId !== '') {
            $c->addCondition("parent_id = {$parentId}");
        }


        $models = NavItems::model()->sorted()->with('menu', 'url');

        if (!$draggable) {
            $models->published();
        }

        $models =  $models->findAll($c);


        foreach ($models as $item)
        {
            if($max_levels !== false && $level > $max_levels) {
                break;
            }

            $class = $item->state ? '' : 'disable';

            if ($item->is_link) {

                if (strpos($item->url, 'http://') === false) {
                    $url = Yii::app()->controller->createUrl('/' . $item->url);
                } else {
                    $url = $item->url;
                }

            } else {
                $url = '#';
            }

            $part = array(
                'active'=> ($item->id == Yii::app()->controller->navigationItemId),
                'url' => $url,
                'items' => self::getMenuContentItems($max_levels, $alias, $draggable, $item->id, $level+1, $isAdmin),
                'label' => $item->title,
            );

            if($draggable) {

                $updateUrl = Yii::app()->createUrl('/navigation/back/save', array('id' => $item->id));
                $deleteUrl = Yii::app()->createUrl('/navigation/back/delete', array('id' => $item->id));


                if ($item->is_link == 1) {
                    $createStatic = Yii::app()->createUrl('/pages/back/NavItem', array('itemId' => $item->id));
                    $linkTpl = "<a class=\"addStatic\" href=\"{$createStatic}\"></a>";
                } else {
                    $linkTpl = '';
                }

                $part['template'] = "<div class=\"{$class}\" data-id=\"{$item->id}\">
                            <span class=\"disclose\"></span>
                            {$item->title}" .
                            ($isAdmin || !$this->allowedPages || in_array($item->id, $this->allowedPages) ? "{$linkTpl}" : "") . ($isAdmin ?
                            "<a class=\"edit\" href=\"{$updateUrl}\"></a>
                            <a class=\"remove\" data-url=\"{$deleteUrl}\"></a>" : "") . "
                        </div>";

            }

            $data[] = $part;
        }
        return $data;
    }
}