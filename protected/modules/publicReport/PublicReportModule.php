<?php

/**
 * Class PublicReportModule
 */
class PublicReportModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'publicReport.models.*',
        ));
    }
}
