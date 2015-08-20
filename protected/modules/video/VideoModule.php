<?php

/**
 * Class VideoModule
 */
class VideoModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'video.enums.*',
            'video.models.*',
            'video.helpers.*',
            'video.components.*',
        ));
    }
}
