<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $model = new Forms('search');

        $model->unsetAttributes();

        if (isset($_GET['Forms']))
        {
            $model->attributes = $_GET['Forms'];
        }

        if ($this->portalId == 1)
            $model->disablePortalCriteria = true;

        $this->render('index', array(
            'model' => $model,
        ));
    }
}