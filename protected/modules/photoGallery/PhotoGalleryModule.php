<?php

/**
 * Class PhotoGalleryModule
 */
class PhotoGalleryModule extends CWebModule
{
    public $defaultController = 'Front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'photoGallery.enums.*',
            'photoGallery.models.*',
            'photoGallery.helpers.*',
            'photoGallery.components.*',
        ));
    }
}
