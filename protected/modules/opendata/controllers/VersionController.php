<?php

class VersionController extends AdminController
{
    public function actionIndex($id)
    {
        if (!$opendata = Opendata::model()->findByPk($id))
            $this->errorTo('/opendata/back', 'Не удалось найти запись');

        $model = new OpendataVersion('search');

        $model->unsetAttributes();

        $model->opendata_id = $id;
        if (isset($_GET['OpendataVersion']))
        {
            $model->attributes = $_GET['OpendataVersion'];
        }

        $this->render('index', array(
            'model' => $model,
            'opendata' => $opendata,
        ));
    }

    public function actionCreate($id)
    {
        if (!$opendata = Opendata::model()->findByPk($id))
            $this->errorTo('/opendata/index', 'Не удалось найти набор данных');

        $model = new OpendataVersion;
        $model->opendata_id = $opendata->id;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OpendataVersion']))
        {
            $model->setAttributes($_POST['OpendataVersion'], false);
            $model->date = strtotime($model->date);

            if ($model->save())
            {
                $this->redirect($this->createUrl('/opendata/version/index', array('id' => $model->opendata_id)));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['OpendataVersion']))
        {
            $model->setAttributes($_POST['OpendataVersion'], false);
            $model->date = strtotime($model->date);

            if ($model->save())
            {
                $this->redirect($this->createUrl('/opendata/version/index', array('id' => $model->opendata_id)));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/opendata/back'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                OpendataVersion::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = OpendataVersion::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'opendata-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}