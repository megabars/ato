<?php

class VerstkaController extends Controller
{
    public function actions()
    {
        return array(
            'captcha' => array(
                'class'     => 'CCaptchaAction',
                'backColor' => 0xe8e8e8,
                'foreColor' => 0x2d8d38,
                'testLimit' => 2,
            ),
        );
    }

    /* Мониторинг */
    public function actionMonitor()
    {
        $gallery = PhotoGalleryPhotos::model()->search();

        $this->render('monitor',array(
            'gallery' => $gallery,
        ));
    }

    public function actionRegion()
    {
        $gallery = PhotoGalleryPhotos::model()->search();
        $news = News::model()->search();

        $this->render('region',array(
            'gallery' => $gallery,
            'news' => $news,
        ));
    }

    public function actionPeople()
    {
        $this->render('people');
    }

    public function actionKadry()    {
        $this->render('kadry');
    }

    /*Административное деление*/
    public function actionMaps()
    {
        $this->render('maps');
    }

}