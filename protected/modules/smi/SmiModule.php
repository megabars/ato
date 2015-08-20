<?php

/**
 * Class SmiModule
 */
class SmiModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'smi.enums.*',
            'smi.models.*',
            'smi.components.*',
        ));
    }
}
