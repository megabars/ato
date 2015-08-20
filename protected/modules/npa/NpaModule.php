<?php

/**
 * Class NpaModule
 */
class NpaModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'npa.enums.*',
            'npa.models.*',
            'npa.components.*',
        ));
    }
}
