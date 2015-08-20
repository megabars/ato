<?php

class MailTemplateController extends AdminController
{
    public function actionIndex()
    {
        $model = new MailTemplate('search');

        $model->unsetAttributes();

        if (isset($_GET['MailTemplate']))
            $model->attributes = $_GET['MailTemplate'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new MailTemplate;

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailTemplate']))
        {
            $model->setAttributes($_POST['MailTemplate'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailTemplate']))
        {
            $model->setAttributes($_POST['MailTemplate'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailtemplate/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailTemplate::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailTemplate::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailtemplate-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
