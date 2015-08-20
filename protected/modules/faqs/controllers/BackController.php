<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Faqs('search');

        $model->unsetAttributes();

        if (isset($_GET['Faqs']))
        {
            $model->attributes = $_GET['Faqs'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Faqs;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Faqs']))
        {

            $model->setAttributes($_POST['Faqs'], false);

            if ($model->save())
            {
                $this->redirect(array('index'));
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

        if (isset($_POST['Faqs']))
        {

            $model->setAttributes($_POST['Faqs'], false);

            if ($model->save())
            {
                $this->redirect(array('index'));
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/faqs/back/index'));
        }
    }

    public function actionOrder($id, $action)
    {
        $model = $this->loadModel($id);

        if ($action == 'up')
        {
            $ordi = $model->ordi + 1;
        }
        else
        {
            $ordi = $model->ordi - 1;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition("ordi = {$ordi}");

        if ($swappedRecord = Faqs::model()->find($criteria))
        {
            if ($action == 'up')
            {
                $swappedRecord->ordi = $ordi - 1;
            }
            else
            {
                $swappedRecord->ordi = $ordi + 1;
            }

            $model->ordi = $ordi;

            $model->save();
            $swappedRecord->save();
        }

        $this->redirect(array('/faqs/back'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Faqs::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Faqs::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'faqs-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}