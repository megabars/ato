<?php

class PeopleGroupController extends AdminController
{
    public function init(){
        $this->pageTitle = 'Типы персоналий';
        $this->breadcrumbs = array(
            $this->pageTitle=>array('/people/peopleGroup'),
        );
        return parent::init();
    }

    public function actionIndex()
    {
        $model = new PeopleGroup('search');

        $model->unsetAttributes();

        if (isset($_GET['PeopleGroup']))
            $model->attributes = $_GET['PeopleGroup'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new PeopleGroup;

        // $this->performAjaxValidation($model);

        if (isset($_POST['PeopleGroup']))
        {
            $model->setAttributes($_POST['PeopleGroup'], false);

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

        if (isset($_POST['PeopleGroup']))
        {
            $model->setAttributes($_POST['PeopleGroup'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = PeopleGroup::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

}
