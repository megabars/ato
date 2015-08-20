<?php

Yii::app()->getModule('counters');

class CountersWidget extends CWidget
{
    public function run()
    {
        foreach (Counters::model()->findAll() as $record)
        {
            echo $record->code;
        }
    }
}