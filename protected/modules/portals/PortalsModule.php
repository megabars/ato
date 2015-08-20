<?php
/**
 * author: Mikhail Matveev
 * Date: 25.11.14 
 */

class PortalsModule extends CWebModule {

    public $defaultController = 'back';

    public function init()
    {
        parent::init();

//        $this->setImport(array(
//            'files.helpers.*',
//            'files.models.*',
//            'files.components.*',
//        ));
    }
}