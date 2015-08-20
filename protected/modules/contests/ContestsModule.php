<?php

class ContestsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'contests.models.*',
            'contests.components.*',
        ));
    }
}