<?php

class BackController extends AdminController
{
     /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new Contest;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Contest']))
        {
            $model->attributes=$_POST['Contest'];
            $model->date_start = strtotime($model->date_start);
            $model->date_end = strtotime($model->date_end);
            $model->date_placed = strtotime($model->date_placed);
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Contest']))
        {
            $model->attributes=$_POST['Contest'];

            $model->date_start = strtotime($model->date_start);
            $model->date_end = strtotime($model->date_end);
            $model->date_placed = strtotime($model->date_placed);

            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($type = 'all')
    {
        $name = array(
            'all' => 'Все конкурсы',
            'opened' => 'Открытые конкурсы',
            'closed' => 'Закрытые конкурсы',
            'archived' => 'Архив конкурсов',
        );
        $dataProvider = new Contest('search');
        if ($type == 'opened')
            $dataProvider = $dataProvider->opened();

        if ($type == 'closed')
            $dataProvider = $dataProvider->closed();

        if ($type == 'archived')
            $dataProvider = $dataProvider->archived();

        $this->render('index',array(
            'type' => $type,
            'name' => $name[$type],
            'model' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new Contest('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Contest']))
            $model->attributes=$_GET['Contest'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contest the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Contest::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contest $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='contest-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}