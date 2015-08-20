<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Contact('search');

        $model->unsetAttributes();

        if (isset($_GET['Contact']))
        {
            $model->attributes = $_GET['Contact'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Contact;

        if (isset($_POST['Contact']))
        {
            $model->setAttributes($_POST['Contact'], false);
            if ($model->save())
            {
                $url = $this->createUrl('/contact/back/update', array('id' => $model->id));
                $this->redirect($url);
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $details = new ContactDetails();
        $details->unsetAttributes();

        if (isset($_GET['ContactDetails']))
        {
            $details->attributes = $_GET['ContactDetails'];
        }
        $details->contact_id = $id;

        if (isset($_POST['Contact']))
        {
            $model->setAttributes($_POST['Contact'], false);

            if ($model->save())
            {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'details' => $details,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/contact/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Contact::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Contact::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}