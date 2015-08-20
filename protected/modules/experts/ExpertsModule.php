<?php

/**
 * Class ExpertsModule
 */
class ExpertsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'experts.enums.*',
            'experts.models.*',
            'experts.components.*',
        ));
    }
}
