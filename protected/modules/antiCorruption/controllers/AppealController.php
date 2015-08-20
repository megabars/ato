<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class AppealController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::APPEAL;
        $this->pageTitle = 'Формы обращений';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            'Комиссия Администрации Томской области по соблюдению требований к служебному поведению' => '/antiCorruption/commission',
            $this->pageTitle
        );
    }
}