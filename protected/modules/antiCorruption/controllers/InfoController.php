<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class InfoController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::INFO;
        $this->pageTitle = 'Информационные материалы';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            'Комиссия Администрации Томской области по соблюдению требований к служебному поведению' => '/antiCorruption/commission',
            $this->pageTitle
        );
    }
}