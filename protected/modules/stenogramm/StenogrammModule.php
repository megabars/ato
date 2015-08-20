<?php

/**
 * Class StenogrammModule
 */
class StenogrammModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'stenogramm.enums.*',
            'stenogramm.models.*',
            'stenogramm.components.*',
        ));
    }
}
