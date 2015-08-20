<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Discuss('search');

        $model->unsetAttributes();

        if (isset($_GET['Discuss']))
        {
            $model->attributes = $_GET['Discuss'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Discuss;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Discuss']))
        {
            $model->setAttributes($_POST['Discuss'], FALSE);
            $model->date_start = strtotime($model->date_start);
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

        if (isset($_POST['Discuss']))
        {
            $model->setAttributes($_POST['Discuss'], FALSE);
            $model->date_start = strtotime($model->date_start);
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/discuss/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
            {
                Discuss::model()->deleteByPk($id);
            }
        }

        echo json_encode(TRUE);
    }

    public function loadModel($id)
    {
        $model = Discuss::model()->findByPk($id);

        if ($model === NULL)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'discuss-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}