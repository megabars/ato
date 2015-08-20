<?php

class MailEmailListController extends AdminController
{
    public function actionIndex()
    {
        $model = new MailEmailList('search');

        $model->unsetAttributes();

        if (isset($_GET['MailEmailList']))
            $model->attributes = $_GET['MailEmailList'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new MailEmailList;

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailEmailList']))
        {
            $model->setAttributes($_POST['MailEmailList'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionCreateFile()
    {
        $model = new FileMailForm;
        $info = array();

        if (isset($_POST['FileMailForm']))
        {

            $model->setAttributes($_POST['FileMailForm'], false);
            if($model->validate())
            {
                $info = $model->saveStruct();
                $model = new FileMailForm;
            }
        }

        $this->render('createFile', array(
            'model' => $model,
            'info' => $info,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailEmailList']))
        {
            $model->setAttributes($_POST['MailEmailList'], false);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailemaillist/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailEmailList::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailEmailList::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailemaillist-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
