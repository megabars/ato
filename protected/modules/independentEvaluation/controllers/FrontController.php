<?php

/**
 * Class FrontController
 */

class FrontController extends Controller
{
    protected $docType;

    public function actionReason()
    {
        $this->docType = DocumentType::REASON;
        $this->rendering();
    }

    public function actionRecommendation()
    {
        $this->docType = DocumentType::RECOMMENDATION;
        $this->rendering();
    }

    public function actionSupport()
    {
        $this->docType = DocumentType::SUPPORT;
        $this->rendering();
    }

    public function actionResult()
    {
        $this->docType = DocumentType::RESULT;
        $this->rendering();
    }

    public function actionRealization()
    {
        $groups = PortalGroup::model()->with('evaluations')->findAll();
        $this->render('realization', array(
            'groups' => $groups
        ));
    }

    protected function rendering()
    {
        $model = new IeFile('search');
        $model->unsetAttributes();

        $model->file_type = $this->docType;

        if (isset($_GET['IeFile'])) {
            $model->attributes = $_GET['IeFile'];
        }

        $this->render('index', array(
            'model' => $model
        ));
    }


}