<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class SituationController extends FileController
{
    public function init()
    {
        parent::init();

        $this->type = DocumentType::SITUATION;
        $this->pageTitle = 'Положение';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            $this->pageTitle
        );
    }
}