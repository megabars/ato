<?php

/**
 * Class DeletedModule
 */
class DeletedModule extends CWebModule
{
    public $defaultController = 'back';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'deleted.models.*',
        ));
    }
}
