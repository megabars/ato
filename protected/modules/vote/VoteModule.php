<?php

class VoteModule extends CWebModule
{
    public $defaultController = 'front';

    public function init()
    {
        parent::init();

        $this->setImport(array(
            'vote.models.*',
            'vote.components.*',
        ));
    }
}