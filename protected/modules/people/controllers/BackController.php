<?php

class BackController extends AdminController
{
    public $people=0;
    public $type=People::GOVERNOR;

    public function beforeAction($action)
    {
        $this->people = People::model()->findByPk((int)@$_GET['people_id']);
        if(!Yii::app()->controller->isMainPortal())
            $this->type=People::IOGV;
        return parent::beforeAction($action);
    }

    public function init(){
        $this->pageTitle = 'Персоналии';
        $this->breadcrumbs = array(
            $this->pageTitle=>array('/people/back'),
        );

        return parent::init();
    }

    public function actionIndex()
    {
        $model = new People('search');

        $model->unsetAttributes();

        if (isset($_GET['People']))
            $model->attributes = $_GET['People'];

        $this->render('index', array(
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

        $this->render('create', array(
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

        $this->render('update', array(
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
                $this->redirect(array('/people/back/update/people_id/'.$people_id));
        }

        $this->render('life', array(
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
                $this->redirect(array('/people/back/update/people_id/'.$people_id));
        }

        $this->render('contacts', array(
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
                $this->redirect(array('/people/back/update/people_id/'.$people_id));
        }

        $this->render('main_info', array(
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

    public function actionSort()
    {
        if (isset($_POST['items']) && is_array($_POST['items'])) {
            $i = 1;
            foreach ($_POST['items'] as $id) {
                $model = $this->loadModel($id);
                $model->order = $i;
                $model->save();
                $i++;
            }
        }
    }

}