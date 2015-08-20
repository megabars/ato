<?php

/**
 * Class ContactModule
 */
class ContactModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'contact.enums.*',
            'contact.models.*',
            'contact.components.*',
        ));
    }

}
