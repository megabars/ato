<?php

class RatingModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'rating.models.*',
            'rating.components.*',
            'rating.enums.*',
        ));
    }
}