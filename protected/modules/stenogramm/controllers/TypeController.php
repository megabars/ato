<?php

class TypeController extends AdminController
{
    public function actionIndex()
    {
        $model = new NewsType('search');

        $model->unsetAttributes();

        if(!UserModule::isAdmin())
            $model->author = Yii::app()->user->id;

        if (isset($_GET['NewsType']))
             $model->attributes = $_GET['NewsType'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new NewsType;
        if (isset($_POST['NewsType']))
        {
            $model->setAttributes($_POST['NewsType'], false);
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

        if (isset($_POST['NewsType']))
        {
            $model->setAttributes($_POST['NewsType'], false);
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
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/news/type'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                NewsType::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = NewsType::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'news-type-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}