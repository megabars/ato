<?php

class StateController extends AdminController
{
    public function actionIndex()
    {
        $model = new StaffState('search');

        $model->unsetAttributes();

        if (isset($_GET['StaffState']))
        {
            $model->attributes = $_GET['StaffState'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new StaffState();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['StaffState']))
        {
            $model->attributes = $_POST['StaffState'];

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

        if (isset($_POST['StaffState']))
        {
            $model->attributes = $_POST['StaffState'];

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
        if ($id != 1 && $id != 2)
            $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/staff/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
            {
                if ($id != 1 && $id != 2)
                    StaffState::model()->deleteByPk($id);
            }
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = StaffState::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'staff-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}