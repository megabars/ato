<?php

class OpendataModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'opendata.models.*',
            'opendata.components.*',
            'opendata.enums.*',
        ));
    }
}