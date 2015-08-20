<?php

/**
 * Class MapModule
 */
class MapModule extends CWebModule
{
    public $defaultController = 'back';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'map.enums.*',
            'map.models.*',
            'map.components.*',
        ));
    }
}
