<?php
Yii::import('application.modules.independentEvaluation.controllers.FileController');

class SupportController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::SUPPORT;
    }
}