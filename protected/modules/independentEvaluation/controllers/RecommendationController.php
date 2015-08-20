<?php
Yii::import('application.modules.independentEvaluation.controllers.FileController');

class RecommendationController extends FileController
{
    public function init()
    {
        parent::init();
        $this->type = DocumentType::RECOMMENDATION;
    }
}