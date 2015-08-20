<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Afisha('search');

        $model->unsetAttributes();

        if (isset($_GET['Afisha']))
        {
            $model->attributes = $_GET['Afisha'];
        }


        $modelCsv=AfishaConf::model()->findByPk(1);
        if($modelCsv===null)
            $modelCsv=new AfishaConf;

        if (isset($_POST['AfishaConf']) && Yii::app()->request->isAjaxRequest)
        {
            $modelCsv->setAttributes($_POST['AfishaConf']);

            if($modelCsv->save()) {
                echo json_encode((object)array('success'=>true));
            } else {
                echo json_encode((object)array('success'=>false, 'error'=>$modelCsv->getError('fileId')));
            }

            Yii::app()->end();
        }



        $this->render('index', array(
            'model' => $model,
            'modelCsv' => $modelCsv,
        ));
    }

    public function actionCreate()
    {
        $model = new Afisha();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Afisha']))
        {
            $model->attributes = $_POST['Afisha'];
            $model->date = strtotime($model->date);
            $model->state_date = strtotime($model->state_date);
            $model->duration = strtotime($model->duration);

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

        if (isset($_POST['Afisha']))
        {
            $model->attributes = $_POST['Afisha'];
            $model->date = strtotime($model->date);
            $model->state_date = strtotime($model->state_date);
            $model->duration = strtotime($model->duration);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/afisha/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Afisha::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Afisha::model()->findByPk($id);

        if ($model === null)
        {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'afisha-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    public function actionSettings()
    {
        $model=AfishaConf::model()->find();

        if($model===null)
            $model=new AfishaConf;

        if(isset($_POST['AfishaConf']))
        {
            $model->attributes=$_POST['AfishaConf'];
            if($model->save())
                $this->redirect(array('index','id'=>$model->id));
        }

        $this->render('settings',array(
            'model'=>$model,
        ));
    }

}