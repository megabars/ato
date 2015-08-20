<?php

class SubportalController extends Controller
{
    /* Главная страница субпортала Экспертного совета */
    public $mainPage = true;

    public function actionIndex()
    {
        $this->layout ='subportal';

        $events = Page::model()->type(RecordType::EVENT)->search();
        $news = News::model()->search();
        $gallery = PhotoGallery::model()->search();
        $maps = Maps::model()->findAll();
        $maps_sorted = Maps::model()->findAllByAttributes(array(),array('order'=> 't.order ASC'));

        $this->render('index', array(
            'events' => $events,
            'news' => $news,
            'gallery' => $gallery,
            'maps' => $maps,
            'maps_sorted' => $maps_sorted
        ));
    }

    public function actionError()
    {
        VarDumper::dump(Yii::app()->errorHandler->error);
        if ($error = Yii::app()->errorHandler->error)
            $this->render('error', $error);
    }

}