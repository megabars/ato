<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Smi('search');

        $model->unsetAttributes();

       if (isset($_GET['Smi']))
        {
            $model->attributes = $_GET['Smi'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Smi();
        $model->title = 'Новая публикация';
        $model->save();

        $this->redirect($this->createUrl('/smi/back/update', array('id' => $model->id)));

//        $model = new Smi;
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['Smi']))
//        {
//            $model->setAttributes($_POST['Smi'], false);
//            $model->date = strtotime($model->date);
//
//            if ($model->save())
//            {
//                $this->redirect(array('index'));
//            }
//        }
//
//        $model->date = $model->date ? date('Y-m-d H:i', $model->date) : date('Y-m-d H:i');
//
//        $this->render('create', array(
//            'model' => $model,
//        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Smi']))
        {
            $model->setAttributes($_POST['Smi'], false);
            $model->date = strtotime($model->date);

            if ($model->save())
            {
                $this->redirect(array('index'));
            }
        }

//        $model->date = date('Y-m-d H:i', $model->date);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/smi/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Smi::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Smi::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'smi-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}