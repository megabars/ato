<?php

Yii::app()->getModule('users');
Yii::app()->getModule('navigation');
Yii::app()->getModule('files');
Yii::app()->getModule('mail');
Yii::app()->getModule('links');
Yii::app()->getModule('vote');
Yii::app()->getModule('contact');


/**
 * Основной контроллер для работы с публичной частью
 * Class Controller
 */
class Controller extends RController
{
    public $layout = '//layouts/main';

    public $breadcrumbs = array();

    public $pageTitle;

    public $mainPage = false;

    /**
     * id выбранного пункта меню
     * @var null
     */
    public $navigationItemId = null;

    public $portalId = 1;

    private $_assetsBase;

    public $contact = null;

    public $user_ip_address = null;

    public function init()
    {
        parent::init();
        Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false;

        // определяемся какой из порталов отображать
        $portal = Portal::model()->findByAttributes(array('alias' => $_SERVER['HTTP_HOST']));
        if ($portal === null) {
            $portal = Portal::model()->findByPk(1);
	    //$portal = new Portal();
        }
        /* TODO нужно как то сделать по человечески */
        if($portal->alias == 'investin.tomsk.dpridprod.ru' //|| $portal->alias == 'test-subportal.ru'
        ) {
            Yii::app()->language = 'en';
        }
        if($portal->alias == 'de.tomsk.dpridprod.ru' //|| $portal->alias == 'test-subportal.ru'
        ) {
            Yii::app()->language = 'de';
        }

        $this->portalId = $portal->id;

        // у кождого портала может быть своя тема
        Yii::app()->theme = $portal->theme;

        // и контактная информация внизу
        $this->contact = Contact::model()->findByAttributes(array('alias'=>'footer', 'portal_id'=>$this->portalId));


        // смена layouts для версии слабовидящих
        if(Yii::app()->session['invalid'] == 'true') {
            $this->layout = '//layouts/invalid';
        }
        else {
            unset(Yii::app()->session['fontsize']);
            unset(Yii::app()->session['themecolor']);
        }

        // попытаемся построить хлебные крошки для страницы, есл и она есть в меню
        /** @todo зачем тримить было ? */
        $pos = strripos($_SERVER['REQUEST_URI'], '?');
        $path = ($pos || $pos != 0) ? mb_substr($_SERVER['REQUEST_URI'], 0, $pos) : $_SERVER['REQUEST_URI'];

        $paths = array_reverse(explode('/',ltrim($path, '/')));

        for($i=1; $i<count($paths); $i++) {
            $navItem = NavItems::model()->with('url')->find('url.url = :requestUrl OR url.url = :fullReq OR url.url = :requestUrlWithSlash', array(
                ':requestUrl' => ltrim($path, '/'),
                ':fullReq' => $path,
                ':requestUrlWithSlash' => $path.'/',
            ));

            if ($navItem !== null) {
                $this->navigationItemId = $navItem->id;
                $this->breadcrumbs = $navItem->getBreadcrumbs();
                break;
            }

            $path = mb_substr($path, 0, strripos($path, '/'));
        }
    }

    public function getAssetsBase()
    {
        if ($this->_assetsBase === null)
        {
            $this->_assetsBase = Yii::app()->assetManager->publish(
                Yii::app()->theme->basePath . '/assets',
                false,
                -1,
                YII_DEBUG
            );
        }

        return $this->_assetsBase;
    }

    /**
     * Редирект на страницу с ошибкой
     * @param $url
     * @param $message
     */
    public function errorTo($url, $message)
    {
        Yii::app()->user->setFlash('error', $message);

        $this->redirect($url);
    }

    /**
     * Редирект на страницу с упешным оповещением
     * @param $url
     * @param $message
     */
    public function noticeTo($url, $message)
    {
        Yii::app()->user->setFlash('notice', $message);

        $this->redirect($url);
    }

    /**
     * Чтобы модуль rights работал...
     * @return array
     */
    public function filters()
    {
        return array(
            'rights'
        );
    }

    /**
     * Регистрирует js, css файлы модуля
     * @param array $js
     * @param array $css
     */
    protected function registerModuleAssetsScripts($js = array(), $css = array())
    {
        $clientScript = Yii::app()->getClientScript();

        $modulePath = $this->getModule()->getBasePath();

        $baseUrl = Yii::app()->assetManager->publish("{$modulePath}/assets");

        foreach ($js as $jsFile)
        {
            $clientScript->registerScriptFile("{$baseUrl}/js/{$jsFile}");
        }

        foreach ($css as $cssFile)
        {
            $clientScript->registerCssFile("{$baseUrl}/css/{$cssFile}");
        }
    }

    public function isMainPortal()
    {
        return ($this->portalId==Yii::app()->params['mainPortalId']);
    }

    /**
     * Можно ли просматриватьт админу субпортала определенный раздел в админке
     * @param $elementName
     * @return bool
     */
    public function visibleNavigationElement($elementName)
    {
        if ($isAdmin = @User::model()->findByPk(Yii::app()->user->id)->superuser)
            return true;

        $dataArray = array(
            'other' => array(),
            'press' => array(271, 256),
            'news' => array(271),
            'afisha' => array(256),
            'event' => array(271),
            'media' => array(271),
            'photo' => array(271),
            'video' => array(271),
            'audio' => array(271),
            'stena' => array(271),
            'smi' => array(271),
            'admin_div' => array(307),
            'pk_npa' => array(270),
            'pk_materials' => array(270),
            'pk_forms' => array(270),
            'pk_about' => array(270),
            'pk_commission' => array(270),
            'appeal' => array(261),
            'staff' => array(270),
            'npa' => array(271, 306),
            'reglaments' => array(271),
            'or_no' => array(257),
            'or_polls' => array(271),

            'ov' => array(271, 268),
            'ov_person' => array(271),
            'ov_life' => array(271),
            'ov_local_people' => array(271),
            'ov_law' => array(271, 268),
            'ov_ter' => array(271),
            'ov_power' => array(271),
            'ov_other' => array(271),
            'ov_local' => array(307),
        );

        $au = UsrAuthAssignment::model()->findByAttributes(array('userid' => (string)Yii::app()->user->id, 'itemname' => 'PortalAdmin'));

        if ($au !== null)
        {
            $data = json_decode($au->data);

            if (!empty($data->portal_id))
            {
                if ($data->portal_id == Yii::app()->controller->portalId)
                    return true;
                else
                    return in_array($data->portal_id, $dataArray[$elementName]);
            }
        }

        return false;
    }
}
