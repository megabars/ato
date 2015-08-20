<?php

class MailGroupEmailListController extends AdminController
{
    public $group;

    public function beforeAction($action)
    {
        if(!$this->group = MailGroup::model()->findByPk((int)@$_GET['group_id']))
            $this->group = MailGroup::model()->find();

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $model = new MailGroupEmailList('search');

        $model->unsetAttributes();

        if (isset($_GET['MailGroupEmailList']))
            $model->attributes = $_GET['MailGroupEmailList'];
        $model->group_id =  @$this->group->id;

        $this->render('index', array(
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
                $info = $model->saveGroupStruct($this->group->id);
                $model = new FileMailForm;
            }
        }

        $this->render('createFile', array(
            'model' => $model,
            'info' => $info,
        ));
    }

    public function actionCreate()
    {
        $model = new MailGroupEmailList;

        // $this->performAjaxValidation($model);

        if (isset($_POST['MailGroupEmailList']))
        {
            $model->setAttributes($_POST['MailGroupEmailList'], false);
            $model->group_id =  @$this->group->id;

            if ($model->save())
                $this->redirect(array('index','group_id'=>@$this->group->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['MailGroupEmailList']))
        {
            $model->setAttributes($_POST['MailGroupEmailList'], false);
            $model->group_id =  @$this->group->id;

            if ($model->save())
                $this->redirect(array('index','group_id'=>@$this->group->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/mailgroupemaillist/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                MailGroupEmailList::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = MailGroupEmailList::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'mailgroupemaillist-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
