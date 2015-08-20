<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class MethodicalController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::METHODICAL;
        $this->pageTitle = 'Методические материалы';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            $this->pageTitle
        );
    }
}