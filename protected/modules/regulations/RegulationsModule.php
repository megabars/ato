<?php

/**
 * Class RegulationsModule
 */
class RegulationsModule extends CWebModule
{

    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'regulations.models.*',
            'regulations.components.*',
        ));
    }
}
