<?php

/**
 * Class SystemsModule
 */
class SystemsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'systems.enums.*',
            'systems.models.*',
            'systems.helpers.*',
            'systems.components.*',
        ));
    }
}
