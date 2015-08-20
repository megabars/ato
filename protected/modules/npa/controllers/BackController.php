<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Npa('search');

        $model->unsetAttributes();

        if (isset($_GET['Npa']))
        {
            $model->attributes = $_GET['Npa'];
        }

        $this->render('index', array(
            'model' => $model->portaled(),
        ));
    }

    public function actionCreate()
    {
        $model = new Npa;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Npa']))
        {
            $model->setAttributes($_POST['Npa'], FALSE);
            $model->date_actual = strtotime($model->date_actual);
            $model->date_finish = strtotime($model->date_finish);
            $model->date_publish = strtotime($model->date_publish);

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

        if (isset($_POST['Npa']))
        {
            $model->setAttributes($_POST['Npa'], FALSE);
            $model->date_actual = strtotime($model->date_actual);
            $model->date_finish = strtotime($model->date_finish);
            $model->date_publish = strtotime($model->date_publish);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/npa/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
            {
                Npa::model()->deleteByPk($id);
            }
        }

        echo json_encode(TRUE);
    }

    public function loadModel($id)
    {
        $model = Npa::model()->findByPk($id);

        if ($model === NULL)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'npa-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}