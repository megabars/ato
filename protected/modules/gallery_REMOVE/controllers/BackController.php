<?php

class BackController extends AdminController
{
    public function actionIndex($type = false)
    {
        $model = new Gallery('search');

        $model->unsetAttributes();

        if (isset($_GET['Gallery']))
        {
            $model->attributes = $_GET['Gallery'];
        }

        $this->render('index', array(
            'model' => $model,
            'type' => $type
        ));
    }

    public function actionCreate()
    {
        $model = new Gallery();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Gallery']))
        {
            $model->setAttributes($_POST['Gallery'], false);
            $model->date = strtotime($model->date);

            if ($model->save())
            {
                $this->redirect(array('index'));
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

        if (isset($_POST['Video']))
        {
            $model->setAttributes($_POST['Video'], false);
            $model->date = strtotime($model->date);

            if ($model->save())
            {
                $this->redirect(array('index'));
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/video/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Video::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Video::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'video-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}