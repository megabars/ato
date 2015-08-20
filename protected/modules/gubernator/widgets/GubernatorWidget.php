<?php

Yii::app()->getModule('gubernator');

class GubernatorWidget extends CWidget
{
    public $limit = 5;
    public $alias = '';

    public function init()
    {

    }

    public function run()
    {
        $this->render('application.themes.tomsk.views.main._guber',array(
            'model' => Gubernator::model()->findAll(),
            'guber' => GubernatorInfo::model()->findByAttributes(array('type'=>'guber'))
        ));
    }
}


