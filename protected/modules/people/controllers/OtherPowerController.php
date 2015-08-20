<?php

class OtherPowerController extends AdminController
{
    public $people=0;
    public $type=People::OTHER_POWER;

    public function beforeAction($action)
    {
        $this->people = People::model()->findByPk((int)@$_GET['people_id']);
        return parent::beforeAction($action);
    }

    public function init(){
        $this->pageTitle = People::getTypeLabels(People::OTHER_POWER);
        $this->breadcrumbs = array(
            $this->pageTitle=>array('/people/otherPower'),
        );
        return parent::init();
    }

    public function actionIndex()
    {
        $model = new People('search');

        $model->unsetAttributes();

        if (isset($_GET['People']))
            $model->attributes = $_GET['People'];

        $this->render('/back/index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new People;
        $model->type = $this->type;

        // $this->performAjaxValidation($model);

        if (isset($_POST['People']))
        {
            $model->setAttributes($_POST['People'], false);

            if ($model->save())
                $this->redirect(array('update','people_id'=>$model->id));
        }

        $this->render('/back/create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($people_id)
    {
        $model = $this->loadModel($people_id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['People']))
        {
            $model->setAttributes($_POST['People'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('/back/update', array(
            'model' => $model,
        ));
    }

    public function actionLife($people_id)
    {
        $model = $this->loadModel($people_id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['People']))
        {
            $model->setAttributes($_POST['People'], false);

            if ($model->save())
                $this->redirect(array('/people/otherPower/update/people_id/'.$people_id));
        }

        $this->render('/back/life', array(
            'model' => $model,
        ));
    }


    public function actionContacts($people_id)
    {
        $model = $this->loadModel($people_id);

        if (isset($_POST['People']))
        {
            $model->setAttributes($_POST['People'], false);

            if ($model->save())
                $this->redirect(array('/people/otherPower/update/people_id/'.$people_id));
        }

        $this->render('/back/contacts', array(
            'model' => $model,
        ));
    }

    public function actionMainInfo($people_id)
    {
        $model = $this->loadModel($people_id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['People']))
        {
            $model->setAttributes($_POST['People'], false);

            if ($model->save())
                $this->redirect(array('/people/otherPower/update/people_id/'.$people_id));
        }

        $this->render('/back/main_info', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/people/back'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                People::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = People::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'people-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

}