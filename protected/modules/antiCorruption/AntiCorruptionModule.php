<?php

/**
 * Class AntiCorruptionModule
 */
class AntiCorruptionModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'antiCorruption.enums.*',
            'antiCorruption.models.*',
            'antiCorruption.components.*',
        ));
    }
}
