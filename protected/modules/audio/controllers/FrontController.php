<?php

class FrontController extends Controller
{
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $count = Audio::model()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 10;
        $pages->applyLimit($criteria);

        $this->render('index', array(
            'records' => Audio::model()->findAll($criteria),
            'pages' => $pages,
        ));
    }
}