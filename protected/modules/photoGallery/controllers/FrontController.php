<?php
/**
 * author: Mikhail Matveev
 * Date: 03.12.14 
 */

class FrontController extends Controller {

    /**
     * Отображения списка галерей
     */
    public function actionIndex(){
        $models = PhotoGallery::model()->published()->findAll();

        $this->render('index', array('gallery' => $models));
    }

    public function actionView($galleryId)
    {
        $model = PhotoGallery::model()->findByPk($galleryId);

        $this->render('view', array(
            'model' => $model
        ));
    }
}