<?php

class PeopleStaffController extends AdminController
{
    public $people;

    public function beforeAction($action)
    {
        $this->people = People::model()->findByPk((int)@$_GET['people_id']);
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        $model = new PeopleStaff('search');

        $model->unsetAttributes();
        $model->people_id=@$this->people->id;

        if (isset($_GET['PeopleStaff']))
            $model->attributes = $_GET['PeopleStaff'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new PeopleStaff;

        // $this->performAjaxValidation($model);

        if (isset($_POST['PeopleStaff']))
        {
            $model->setAttributes($_POST['PeopleStaff'], false);
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

        if (isset($_POST['PeopleStaff']))
        {
            $model->setAttributes($_POST['PeopleStaff'], false);
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/peopleStaff/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                PeopleStaff::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = PeopleStaff::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'peoplestaff-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
