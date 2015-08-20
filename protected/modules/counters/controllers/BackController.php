<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Counters('search');

        $model->unsetAttributes();

        if (isset($_GET['Counters']))
        {
            $model->attributes = $_GET['Counters'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Counters;

        if (isset($_POST['Counters']))
        {

            $model->setAttributes($_POST['Counters'], false);

            if ($model->save())
            {
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

        if (isset($_POST['Counters']))
        {

            $model->setAttributes($_POST['Counters'], false);

            if ($model->save())
            {
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
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/counters/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Counters::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Counters::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }
}