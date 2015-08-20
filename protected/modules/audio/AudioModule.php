<?php

/**
 * Class AudioModule
 */
class AudioModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'audio.helpers.*',
            'audio.models.*',
        ));
    }
}
