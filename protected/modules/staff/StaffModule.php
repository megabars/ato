<?php

class StaffModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'staff.models.*',
            'staff.components.*',
            'staff.enums.*',
        ));
    }
}