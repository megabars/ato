<?php

class MailSubscribeFilesController extends AdminController
{
    public $subscribe;

    public function beforeAction($action)
    {
        if(!$this->subscribe = MailSubscribe::model()->findByPk((int)@$_GET['subscribe']))
            $this->subscribe = MailSubscribe::model()->find();

        return parent::beforeAction($action);
    }
    public function actionIndex()
    {
        $model = new MailSubscribeFiles('search');

        $model->unsetAttributes();

        if (isset($_GET['MailSubscribeFiles']))
            $model->attributes = $_GET['MailSubscribeFiles'];
        $model->subscribe_id = $this->subscribe->id;

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new MailSubscribeFiles;

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailSubscribeFiles']))
        {
            $model->setAttributes($_POST['MailSubscribeFiles'], false);
            $model->subscribe_id =  @$this->subscribe->id;

            if ($model->save())
                $this->redirect(array('index','subscribe'=>@$this->subscribe->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailSubscribeFiles']))
        {
            $model->setAttributes($_POST['MailSubscribeFiles'], false);
            $model->subscribe_id =  @$this->subscribe->id;

            if ($model->save())
                $this->redirect(array('index','subscribe'=>@$this->subscribe->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailsubscribefiles/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailSubscribeFiles::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailSubscribeFiles::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailsubscribefiles-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
