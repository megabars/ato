<?php

/**
 * Class DiscussModule
 */
class DiscussModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'discuss.enums.*',
            'discuss.models.*',
            'discuss.components.*',
        ));
    }
}
