<?php

Yii::app()->getModule('news');

class LatestNewsWidget extends CWidget
{
    public $limit = 5;
    public $alias = '';

    public function init()
    {

    }

    public function run()
    {
        $this->render('index', array(
            'records' => News::model()->limit($this->limit)->sorted()->alias($this->alias)->published()->findAll(),
        ));
    }
}