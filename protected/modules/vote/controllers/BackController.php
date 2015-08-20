<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Vote('search');

        $model->unsetAttributes();

        if (isset($_GET['Vote']))
            $model->attributes = $_GET['Vote'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new Vote;

        if (isset($_POST['Vote']))
        {
            $model->attributes = $_POST['Vote'];
            $model->finish = strtotime($model->finish);
            $model->date_publish = strtotime($model->date_publish);

            $transact = Yii::app()->db->beginTransaction();

            if ($model->validate() && $model->saveItems())
            {
                $transact->commit();

                $this->redirect($this->createUrl('/vote/back'));
            }

            $transact->rollBack();

            $model->finish = date("Y-m-d H:i", $model->finish);
            $model->date_publish = date("Y-m-d H:i", $model->date_publish);
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Vote']))
        {
            $model->attributes = $_POST['Vote'];
            $model->finish = strtotime($model->finish);
            $model->date_publish = strtotime($model->date_publish);

            $transact = Yii::app()->db->beginTransaction();

            if ($model->validate() && $model->saveItems())
            {
                $transact->commit();

                $this->redirect($this->createUrl('/vote/back'));
            }

            $transact->rollBack();

            $model->finish = date("Y-m-d H:i", $model->finish);
            $model->date_publish = date("Y-m-d H:i", $model->date_publish);
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function loadModel($id)
    {
        $model = Vote::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');

        return $model;
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/vote/back/index'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Vote::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }


    public function actionRatings()
    {
        $model = VoteResult::model()->findByPk(1);

        if (isset($_POST['VoteResult']))
        {
            $model->attributes = $_POST['VoteResult'];

            if ($model->save())
                $this->redirect($this->createUrl('/vote/back'));
        }

        $this->render('ratings', array(
            'model' => $model,
        ));
    }
}