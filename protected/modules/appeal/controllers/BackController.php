<?php

class BackController extends AdminController
{
    public $staticPage = null;

    /**
     * Инфа в модуле завязана на обычную статическую страницу
     */
    public function init()
    {
        parent::init();
        $this->staticPage = UrlManager::getAppealPage();
    }

    public function actionIndex($page)
    {
        $url = '/admin';

        // общая информация это статика, просто редиректим на ее редактирование
        if ($page == 'main_info' && isset($this->staticPage->id))
            $url = $this->createUrl('/pages/back/update', array('id' => $this->staticPage->id, 'type' => $this->staticPage->type_id));

        $this->redirect($url);
    }
}