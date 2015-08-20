<?php

/**
 * Class NewsModule
 */
class NewsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'news.enums.*',
            'news.models.*',
            'news.components.*',
            'news.helpers.*',
        ));
    }
}
