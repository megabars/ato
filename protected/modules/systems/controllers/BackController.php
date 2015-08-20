<?php

class BackController extends AdminController
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

    public function actionCreate()
    {
        $model = new Systems();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Systems']))
        {
            $model->setAttributes($_POST['Systems'], false);

            if ($model->save())
            {
                $this->noticeTo($this->createUrl('/systems/back/index'), 'Запись успешно сохранена.');
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

        if (isset($_POST['Systems']))
        {
            $model->setAttributes($_POST['Systems'], false);

            if ($model->save())
            {
                $this->noticeTo($this->createUrl('/systems/back/index'), 'Запись успешно сохранена.');
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/systems/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Systems::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Systems::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']))
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}