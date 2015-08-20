<?php

class PeopleUnitController extends AdminController
{
    public $people;

    public function beforeAction($action)
    {
        $this->people = People::model()->findByPk((int)@$_GET['people_id']);
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $model = new PeopleUnit('search');

        $model->unsetAttributes();
        $model->people_id=@$this->people->id;

        if (isset($_GET['PeopleUnit']))
            $model->attributes = $_GET['PeopleUnit'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new PeopleUnit;

        // $this->performAjaxValidation($model);

        if (isset($_POST['PeopleUnit']))
        {
            $model->setAttributes($_POST['PeopleUnit'], false);
            $model->people_id =  @$this->people->id;

            if ($model->save())
                $this->redirect(array('index','people_id'=>@$this->people->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['PeopleUnit']))
        {
            $model->setAttributes($_POST['PeopleUnit'], false);
            $model->people_id =  @$this->people->id;

            if ($model->save())
                $this->redirect(array('index','people_id'=>@$this->people->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/peopleUnit/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                PeopleUnit::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = PeopleUnit::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'peopleunit-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
