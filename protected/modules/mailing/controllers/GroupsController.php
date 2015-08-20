<?php

class GroupsController extends AdminController
{
    public $groups;

    public function beforeAction($action)
    {
        $this->groups = Yii::app()->mailchimp->listGroups();
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $this->render('index',array('groups'=>$this->groups));
    }

    public function actionCreate()
    {
        $model = new GroupsForm();

        if (isset($_POST['GroupsForm']))
        {
            $model->setAttributes($_POST['GroupsForm'], false);
            $result = Yii::app()->mailchimp->groupAdd($model->name);
            if(!empty($result['id']))
                $this->redirect(array('index'));
            else
                $model->addError('name',@$result['error']);
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['GroupsForm']))
        {
            $model->setAttributes($_POST['GroupsForm'], false);
            $result = Yii::app()->mailchimp->groupUpdateName($model->name,$id);
            var_dump($result);
            if(!empty($result['complete']))
                $this->redirect(array('index'));
            else
                $model->addError('name',@$result['error']);
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        Yii::app()->mailchimp->groupDelete($id);
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/mailing/groups/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
            foreach ($_POST['ids'] as $id)
            {
                $model = $this->loadModel($id);
                Yii::app()->mailchimp->groupDelete($id);
            }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = new GroupsForm();
        if(!empty($this->groups))
            foreach($this->groups as $group)
                if($group['id']==$id)
                    $model->attributes=$group;

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'groups-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
