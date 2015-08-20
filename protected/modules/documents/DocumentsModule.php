<?php

/**
 * Class DocumentsModule
 */
class DocumentsModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'documents.models.*',
            'documents.components.*',
        ));
    }
}
