<?php

/**
 * Class FilesModule
 */
class FilesModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'files.helpers.*',
            'files.models.*',
            'files.components.*',
        ));
    }
}
