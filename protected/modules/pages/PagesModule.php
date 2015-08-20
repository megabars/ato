<?php

/**
 * Class PagesModule
 */
class PagesModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'pages.models.*',
            'pages.components.*',
        ));
    }
}
