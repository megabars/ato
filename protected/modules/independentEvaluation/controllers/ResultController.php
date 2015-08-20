<?php
Yii::import('application.modules.independentEvaluation.controllers.FileController');

class ResultController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::RESULT;
    }
}