<?php

class ExpertsController extends AdminController
{
    public function actionIndex()
    {
        $model = new Experts('search');

        $model->unsetAttributes();

        if (isset($_GET['Experts']))
            $model->attributes = $_GET['Experts'];

        $this->render('index', array(
            'model' => $model,
        ));
    }


    public function actionView($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Experts']))
        {
            $model->setAttributes($_POST['Experts'], false);

            if ($model->save())
                $this->redirect(array('index'));
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $model_resourse = new ExpertsForm();

        if (isset($_POST['Experts']))
        {
            //var_dump($_POST['ExpertsResources']);die;

            $model->setAttributes($_POST['Experts'], false);

            if ($model->save()) {

                if (isset($_POST['ExpertsResources'])) {
                    $post = $_POST['ExpertsResources'];
                    foreach($post['type'] as $key => $item) {
                        $models = new ExpertsResources();
                        $models->type = $post['type'][$key];
                        $models->url = $post['url'][$key];
                        $models->experts_id = $model->id;
                        $models->save();
                    }
                }

                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'model_resourse' => $model_resourse,
        ));
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/admin/experts/index'));
    }

    public function actionDeleteResource($id)
    {
        $model = ExpertsResources::model()->findByPk($id);

        if($model->delete()) {
            echo 'success';
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Experts::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Experts::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'experts-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}
