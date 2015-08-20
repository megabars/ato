<?php

/**
 * Class LinksModule
 */
class LinksModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'links.models.*',
            'links.components.*',
        ));
    }
}
