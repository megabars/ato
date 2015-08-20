<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class MeetingController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::MEETING;
        $this->pageTitle = 'Материалы заседаний';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            'Комиссия Администрации Томской области по соблюдению требований к служебному поведению' => '/antiCorruption/commission',
            $this->pageTitle
        );
    }
}