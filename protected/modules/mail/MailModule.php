<?php

/**
 * Class MailModule
 */
class MailModule extends CWebModule
{
    public $defaultController = 'back';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'mail.helpers.*',
            'mail.models.*',
            'mail.components.*',
        ));
    }
}
