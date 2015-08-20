<?php

class BackController extends AdminController
{
    public function actionIndex()
    {
        $model = new Experts('search');

        $model->unsetAttributes();

        if (isset($_GET['Experts'])) {
            $model->attributes = $_GET['Experts'];
        }

        $this->render('index', array(
            'model' => $model,
            'hasFileExport' => file_exists('uploads/experts.csv') ? true : false,
            'fileCreated' => file_exists('uploads/experts.csv') ? date('d-m-Y H:i', filemtime($_SERVER['DOCUMENT_ROOT'].$this->createUrl('/uploads/experts.csv'))) : ''
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Experts']))
        {
            $model->setAttributes($_POST['Experts'], false);

            if ($model->save()) {
                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/experts/back'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $model = $this->loadModel($id);
                $model->delete();
            }
        }
        echo json_encode(true);
    }

    public function actionExportAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            file_put_contents('uploads/experts.csv', 'Дата заполнения;ФИО;Экспертный совет;Адрес'."\n");
            foreach ($_POST['ids'] as $id) {
                $model = $this->loadModel($id);
                file_put_contents('uploads/experts.csv',  $model->date.';'.$model->fio.';'.$model->expert_council_id.';'.$model->address."\n", FILE_APPEND);
            }
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