<?php

Yii::app()->getModule('vote');

class VoteWidget extends CWidget
{
    public $data = null;

    public function init()
    {
        if ($this->data === null) {
            $this->data = Vote::model()->with(array('answersCount', 'items', 'items.answersCount'))->limit(1)->sorted()->published()->find();
        }
    }

    public function run()
    {
        $this->render('index', array(
            'record' => $this->data,
        ));
    }
}