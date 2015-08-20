<?php

class MailGroupController extends AdminController
{
    public function actionIndex()
    {
        $model = new MailGroup('search');

        $model->unsetAttributes();

        if (isset($_GET['MailGroup']))
            $model->attributes = $_GET['MailGroup'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new MailGroup;

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailGroup']))
        {
            $model->setAttributes($_POST['MailGroup'], false);

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

        if (isset($_POST['MailGroup']))
        {
            $model->setAttributes($_POST['MailGroup'], false);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailgroup/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailGroup::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailGroup::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailgroup-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
