<?php

Yii::app()->getModule('links');

class LinksWidget extends CWidget
{

    public $alias = 'main';

    public function init()
    {

    }

    public function run()
    {
        $group = LinksGroup::model()->findByAttributes(array('alias' => $this->alias));
        if ($group !== null)
            $data = $group->links;
        else
            $data = array();


        $this->render('index', array(
            'records' => $data,
        ));
    }
}