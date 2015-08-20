<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array('script.js'), array());
    }

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionView()
    {
        $criteria = new CDbCriteria();

        $count = Video::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $this->render('view', array(
            'records' => Video::model()->published()->findAll($criteria),
            'pages' => $pages,
        ));
    }
}