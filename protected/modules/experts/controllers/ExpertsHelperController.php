<?php

class ExpertsHelperController extends AdminController
{
    public function actionIndex()
    {
        $model = new ExpertsHelper('search');
        $modelSettings = $this->loadSettingsModel();
        if (empty($modelSettings)) {
            $modelSettings = new ExpertSettings();
        }

        if (isset($_POST['ExpertSettings'])) {
            $modelSettings->setAttributes(array('id'=>1)+$_POST['ExpertSettings'], false);
            $modelSettings->save();
        }

        $model->unsetAttributes();

        if (isset($_GET['ExpertsHelper']))
            $model->attributes = $_GET['ExpertsHelper'];

        $this->render('index', array(
            'model' => $model,
            'modelSettings' => $modelSettings,
        ));
    }

    public function actionCreate()
    {
        $model = new ExpertsHelper;

        // $this->performAjaxValidation($model);

        if (isset($_POST['ExpertsHelper']))
        {
            $model->setAttributes($_POST['ExpertsHelper'], false);

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

        if (isset($_POST['ExpertsHelper']))
        {
            $model->setAttributes($_POST['ExpertsHelper'], false);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/expertshelper/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                ExpertsHelper::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = ExpertsHelper::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    public function loadSettingsModel()
    {
        $model = ExpertSettings::model()->findAll(array('limit'=>1));
        if ($model === NULL)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return isset($model[0]) ? $model[0] : $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expertshelper-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
