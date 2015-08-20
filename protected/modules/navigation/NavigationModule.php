<?php

/**
 * Class NavigationModule
 */
class NavigationModule extends CWebModule
{
    public $defaultController = 'menu';

    public $allowMenuTypes = false;

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'navigation.models.*',
            'navigation.components.*',
        ));
    }
}
