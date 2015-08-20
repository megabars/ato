<?php

/**
 * Class AfishaModule
 */
class AfishaModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'afisha.models.*',
        ));
    }
}
