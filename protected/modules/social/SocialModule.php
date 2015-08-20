<?php

class SocialModule extends CWebModule
{
    public $defaultController = 'back';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'social.models.*',
            'social.enums.*',
        ));
    }
}