<?php

/**
 * Class FormsModule
 */
class FormsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'forms.enums.*',
            'forms.models.*',
            'forms.helpers.*',
            'forms.components.*',
        ));
    }
}
