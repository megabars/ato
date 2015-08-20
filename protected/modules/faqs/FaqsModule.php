<?php

/**
 * Class FaqsModule
 */
class FaqsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'faqs.models.*',
            'faqs.components.*',
        ));
    }
}
