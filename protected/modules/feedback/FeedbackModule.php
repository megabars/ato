<?php

/**
 * Class FeedbackModule
 */
class FeedbackModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'feedback.models.*',
            'feedback.enums.*',
            'feedback.components.*',
        ));
    }
}
