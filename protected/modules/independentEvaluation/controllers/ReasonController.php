<?php
Yii::import('application.modules.independentEvaluation.controllers.FileController');

class ReasonController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::REASON;
    }
}