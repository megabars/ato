<?php

Yii::import('zii.widgets.grid.CGridView');
Yii::import('application.widgets.adminPager');

class adminGridView extends CGridView
{
    public $cssFile = false;

    public function init()
    {
        $this->cssFile = Yii::app()->controller->assetsBase . '/css/gridview.css';

        $this->pager = array(
            'class' => 'adminPager',
        );

        parent::init();
    }

    public function registerClientScript()
    {
        parent::registerClientScript();

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->controller->assetsBase . '/js/customCAdminGridView.js');
    }
}