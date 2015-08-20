<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $model = new Systems('search');

        $model->unsetAttributes();

        if (isset($_GET['Systems']))
        {
            $model->attributes = $_GET['Systems'];
        }

        if ($this->portalId == 1)
            $model->disablePortalCriteria = true;

        $this->render('index', array(
            'model' => $model,
        ));
    }
}