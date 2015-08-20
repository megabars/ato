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
        $criteria->order = 'date DESC';

        $count = VideoGalleryVideos::model()->published()->count($criteria);

        $pages = new CPagination($count);
        $pages->pageSize = 9;
        $pages->applyLimit($criteria);

        $this->render('view', array(
            'records' => VideoGalleryVideos::model()->published()->findAll($criteria),
            'pages' => $pages,
        ));
    }
}