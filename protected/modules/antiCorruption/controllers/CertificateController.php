<?php
Yii::import('application.modules.antiCorruption.controllers.FileController');

class CertificateController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::CERTIFICATE;
        $this->pageTitle = 'Формы справок о доходах и расходах';

        $this->breadcrumbs = array(
            'Противодействие коррупции' => '/antiCorruption/back',
            $this->pageTitle
        );
    }
}