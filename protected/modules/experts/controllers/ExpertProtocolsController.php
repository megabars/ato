<?php

class ExpertProtocolsController extends AdminController
{
    public function actionIndex()
    {
        $model = new ExpertProtocols('search');

        $model->unsetAttributes();

        if (isset($_GET['ExpertProtocols']))
            $model->attributes = $_GET['ExpertProtocols'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new ExpertProtocols;

        // $this->performAjaxValidation($model);

        if (isset($_POST['ExpertProtocols']))
        {
            $model->setAttributes($_POST['ExpertProtocols'], false);

            if ($model->save()) {

                if (isset($_POST['ExpertProtocols']['expertsHelperIds']))
                    $model->saveRelated($_POST['ExpertProtocols']['expertsHelperIds']);

                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // $this->performAjaxValidation($model);

        if (isset($_POST['ExpertProtocols']))
        {
            $model->setAttributes($_POST['ExpertProtocols'], false);

            if ($model->save()) {

                if (isset($_POST['ExpertProtocols']['expertsHelperIds']))
                    $model->saveRelated($_POST['ExpertProtocols']['expertsHelperIds']);

                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/expertprotocols/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                ExpertProtocols::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = ExpertProtocols::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'expertprotocols-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
