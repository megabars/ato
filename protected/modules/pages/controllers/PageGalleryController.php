<?php
/**
 * author: Mikhail Matveev
 * Date: 27.02.15
 */

Yii::import('application.modules.photoGallery.controllers.BackController');

class PageGalleryController extends BackController
{
    public function actionUpdate($id)
    {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PageGallery'])) {

            if (isset($_POST['PageGallery']['photoGalleryPhotos'])) {
                $photoIds = array_values($_POST['PageGallery']['photoGalleryPhotos']);
                $model->updateGallery($photoIds);
            }

            if (!$model->save()) {
                throw new CHttpException(500, 'Cant save gallery/ Errors:'.print_r($model->getErrors(), false));
            }

        } else {
            $this->renderPartial('_form', array(
                'model' => $model,
            ), false, true);
        }
    }

    public function actionDelete($id) {
        $model = PhotoGalleryPhotos::model()->findByPk($id);
        $count = count($model->photoGallery->photoGalleryPhotos) - 1;
        $model->delete();
        echo $count;
    }


    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
            {
                PhotoGalleryPhotos::model()->deleteByPk($id);
            }
        }

        echo json_encode(TRUE);
    }

    public function loadModel($id)
    {
        $model = PageGallery::model()->findByPk($id);

        if ($model === NULL)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }


}