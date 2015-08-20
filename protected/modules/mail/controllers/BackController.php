<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        if (($model = SettingsMail::model()->find()) == null)
            $model = new SettingsMail();

        if (isset($_POST['SettingsMail']))
        {
            $model->attributes = $_POST['SettingsMail'];

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}