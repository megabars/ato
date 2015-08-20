<?php

class AllPhotoController extends AdminController
{
    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new PhotoGalleryPhotos('search');

        $model->unsetAttributes();

        if (isset($_GET['PhotoGalleryPhotos'])) {
            $model->attributes = $_GET['PhotoGalleryPhotos'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }
}