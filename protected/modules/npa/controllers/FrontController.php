<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->navigationItemId = 1599;
    }

    public function actionIndex()
    {
        $model = new Npa('search');

        $model->unsetAttributes();

        if (isset($_GET['Npa']))
        {
            $model->attributes = $_GET['Npa'];
        }


        $this->render('index', array(
            'model' => $model->portaled(),
            'count' => Npa::model()->portaled()->count(),
            'executives' => Executive::model()->findAll()

        ));
    }

    public function actionArchive()
    {
        $model = new Npa('search');

        $model->unsetAttributes();

        if (isset($_GET['Npa']))
        {
            $model->attributes = $_GET['Npa'];
        }


        $this->render('archive', array(
            'model' => $model->portaled()->archived(),
            'count' => Npa::model()->portaled()->archived()->count(),
            'executives' => Executive::model()->findAll()

        ));
    }

    public function actionView($id)
    {
        $model = Npa::model()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
            'file' => File::model()->findByPk($model->file),
        ));
    }
}