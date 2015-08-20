<?php

/**
 * Class GuberModule
 */
class GubernatorModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'gubernator.models.*',
        ));
    }
}
