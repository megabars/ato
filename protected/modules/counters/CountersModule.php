<?php

/**
 * Class CountersModule
 */
class CountersModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'counters.models.*',
            'counters.components.*',
        ));
    }
}
