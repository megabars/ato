<?php

class FrontController extends Controller
{
    public function init()
    {
        parent::init();

        $this->registerModuleAssetsScripts(array('front.js'), array('front.css'));
    }

    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $count = Faqs::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 20;
        $pages->applyLimit($criteria);

        $this->render('index', array(
            'records' => Faqs::model()->sorted()->findAll($criteria),
            'pages' => $pages,
        ));
    }
}