<?php

class MenuController extends AdminController
{
    public function actionIndex()
    {
        $model = new NavMenu('search');

        $model->unsetAttributes();

        if (isset($_GET['NavMenu']))
            $model->attributes = $_GET['NavMenu'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new NavMenu;

        // $this->performAjaxValidation($model);

        if (isset($_POST['NavMenu']))
        {
            $model->attributes = $_POST['NavMenu'];

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

        if (isset($_POST['NavMenu']))
        {
            $model->attributes = $_POST['NavMenu'];

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $result = $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/navmenu/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                NavMenu::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = NavMenu::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'navmenu-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
