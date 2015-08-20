<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new PhotoGallery('search');

        $model->unsetAttributes();

        if (isset($_GET['PhotoGallery']))
            $model->attributes = $_GET['PhotoGallery'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new PhotoGallery();
        $model->title = 'Новая фотогалерея';
        $model->save();

        $this->redirect($this->createUrl('/photoGallery/back/update', array(
            'id' => $model->id
        )));
    }



    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PhotoGallery'])) {
            $model->attributes = $_POST['PhotoGallery'];

            if (isset($_POST['PhotoGallery']['photoGalleryPhotos'])) {
                $photoIds = array_values($_POST['PhotoGallery']['photoGalleryPhotos']);
                $model->updateGallery($photoIds);
            }

            if ($model->save()) {
                $this->redirect(
                    $this->createUrl('/photoGallery/back/index')
                );

            }


        }

        if (Yii::app()->request->isAjaxRequest && !isset($_GET['ajax'])) {

            $cs = Yii::app()->getClientScript();
            $cs->scriptMap = array(
                '*.js' => false,
                '*.css' => false
            );

            $this->renderPartial('_tableForm', array(
                'model' => $model,
            ), false, true);

        } else {
            $this->render('update', array(
                'model' => $model,
            ));
        }
    }

    public function actionUpdatePhoto($id, $name)
    {
        $model = PhotoGalleryPhotos::model()->findByPk($id);
        $model->title = $name;

        if (!$model->save())
            echo json_encode($model->getErrors());
        else
            echo 'success';
    }

    public function actionUpdateSort()
    {
        if (isset($_POST['data'])) {
            foreach ($_POST['data'] as $item) {
                $model = PhotoGalleryPhotos::model()->findByPk($item['id']);
                $model->ordi = $item['order'];
                $model->save();
            }
        }
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/photoGallery/back/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                PhotoGallery::model()->deleteByPk($id);
            }
        }

        echo json_encode(TRUE);
    }

    public function actionDeletePhoto($id)
    {
        $model = PhotoGalleryPhotos::model()->findByPk($id);
        $count = count($model->photoGallery->photoGalleryPhotos) - 1;
        $model->delete();
        echo $count;
    }

    public function actionDeletePhotoAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                PhotoGalleryPhotos::model()->deleteByPk($id);
            }
        }

        echo json_encode(TRUE);
    }

    public function loadModel($id)
    {
        $model = PhotoGallery::model()->findByPk($id);

        if ($model === NULL)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'gallery-form') {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}