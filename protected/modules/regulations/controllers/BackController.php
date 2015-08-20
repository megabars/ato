<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new Regulation('search');

        $model->unsetAttributes();

        if (isset($_GET['Documents'])) {
            $model->attributes = $_GET['Documents'];
        }
        $this->render('index', array(
            'model' => $model->portaled(),
        ));
    }

    public function actionSave($id=null)
    {
        if($id == null) {
            $model = new Regulation;
//            $model->setScenario('npa');
            if (isset($_POST['Regulation'])) {
                $model->setAttributes($_POST['Regulation'], false);
                $model->date_real = strtotime($model->date_real);
                $model->date_public = strtotime($model->date_public);

                if (!$model->save()) {
                    throw new CHttpException(500, 'Документ не создан');
                }
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['Regulation'])){
                $model->setAttributes($_POST['Regulation'], false);
                $model->date_real = strtotime($model->date_real);
                $model->date_public = strtotime($model->date_public);

                if (!$model->save()) {
                    throw new CHttpException(500, 'Документ не отредактирован');
                }
            } else { // отдаем заполненную форму
                $this->getForm($model);
            }
        }
    }




    public function actionCreate()
    {
        $model = new Regulation;

        if (isset($_POST['Regulation'])) {
            $model->setAttributes($_POST['Regulation']);
            $model->date_real = strtotime($model->date_real);
            $model->date_public = strtotime($model->date_public);

            if ($model->save())  {
                $this->noticeTo($this->createUrl('/regulations/back/index'), 'Запись успешно сохранена');
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Regulation']))  {
            $model->setAttributes($_POST['Regulation']);
            $model->date_real = strtotime($model->date_real);
            $model->date_public = strtotime($model->date_public);

            if ($model->save()) {
                $this->noticeTo($this->createUrl('/regulations/back/index'), 'Запись успешно сохранена');
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/documents/back'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Regulation::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Regulation::model()->portaled()->findByPk($id);

        $model->setScenario('npa');

        if ($model === null) {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documents-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    protected  function getForm($model) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
//            '*.js' => false,
            '*.css' => false,
            'back.js' => false,
            'ckeditor.js' => false,
            'ckfinder.js' => false,
            'ckfinder.js' => false,
            'fileuploader.js' => false,
            'jquery.js' => false,
            'jquery.yiiactiveform.js' => false,
        );

        $this->renderPartial('_form', array('model' => $model), false, true);
    }
}