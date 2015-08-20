<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new VideoGalleryVideos('search');

        $model->unsetAttributes();

        if (isset($_GET['VideoGalleryVideos']))
        {
            $model->attributes = $_GET['VideoGalleryVideos'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new VideoGalleryVideos();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['VideoGalleryVideos']))
        {
            $model->setAttributes($_POST['VideoGalleryVideos'], false);

            if ($model->save())
            {
                $this->noticeTo($this->createUrl('/video/back/index'), 'Запись успешно сохранена. Процесс обработки видео запущен в фоновом режиме. Видео на портале будет доступно сразу после завершения обработки.');
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['VideoGalleryVideos']))
        {
            $model->setAttributes($_POST['VideoGalleryVideos'], false);
            $model->date = strtotime($model->date);

            if ($model->mp4 != $model->prevVideo)
            {
                $model->webm = null;
                $model->ogv = null;
            }

            if ($model->save())
            {
                $this->noticeTo($this->createUrl('/video/back/index'), 'Запись успешно сохранена. Процесс обработки видео запущен в фоновом режиме. Видео на портале будет доступно сразу после завершения обработки.');
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/video/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                VideoGalleryVideos::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = VideoGalleryVideos::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']))
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}