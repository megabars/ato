<?php

/**
 * Class AppealModule
 */
class AppealModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'appeal.enums.*',
            'appeal.models.*',
            'appeal.components.*',
        ));
    }
}
