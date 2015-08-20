<?php

class MailSubscribeController extends AdminController
{
    public function actionIndex()
    {
        $model = new MailSubscribe('search');

        $model->unsetAttributes();

        if (isset($_GET['MailSubscribe']))
            $model->attributes = $_GET['MailSubscribe'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new MailSubscribe;

        if (isset($_POST['MailSubscribe']))
        {
            $model->setAttributes($_POST['MailSubscribe'], false);
            $model->date = strtotime($model->date);

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

        if (isset($_POST['MailSubscribe']))
        {
            $model->setAttributes($_POST['MailSubscribe'], false);
            $model->date = strtotime($model->date);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailsubscribe/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailSubscribe::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailSubscribe::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailsubscribe-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
