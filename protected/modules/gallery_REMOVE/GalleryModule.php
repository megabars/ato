<?php

/**
 * Class GalleryModule
 */
class GalleryModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'gallery.enums.*',
            'gallery.models.*',
            'gallery.helpers.*',
            'gallery.components.*',
        ));
    }
}
