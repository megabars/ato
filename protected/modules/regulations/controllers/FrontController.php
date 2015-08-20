<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array(), array('front.css'));
    }

    public function actionIndex()
    {
        $documents = new Regulation('search');

        $documents->unsetAttributes();
        if(isset($_GET['Regulation'])) {
            $documents->attributes=$_GET['Regulation'];
        }

        $this->render('index', array(
            'documents' => $documents->portaled(),
        ));
    }

    public function actionView($id)
    {
        $model = Regulation::model()->portaled()->findByPk($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }
}