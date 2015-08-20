<?php

class ExpertiseController extends AdminController
{
    public function actionIndex()
    {
        Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        CJuiDateTimePicker::registerScripts();
        FileUpload::registerScripts();

        $model = new AcExpertise('search');

        $model->unsetAttributes();

        if (isset($_GET['AcExpertise'])) {
            $model->attributes = $_GET['AcExpertise'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionSave($id=null)
    {
        if($id == null) {
            $model = new AcExpertise;

            if (isset($_POST['AcExpertise'])) {
                $model->setAttributes($_POST['AcExpertise'], false);
                $model->date_start = strtotime($model->date_start);
                $model->date_finish = strtotime($model->date_finish);
                $model->date_publish = strtotime($model->date_publish);

                if (!$model->save())
                    throw new CHttpException(500, 'Проект не создан');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);

            if (isset($_POST['AcExpertise'])){
                $model->setAttributes($_POST['AcExpertise'], false);
                $model->date_start = strtotime($model->date_start);
                $model->date_finish = strtotime($model->date_finish);
                $model->date_publish = strtotime($model->date_publish);

                if (!$model->save())
                    throw new CHttpException(500, 'Проект не отредактирован');
            } else { // отдаем заполненную форму
                $this->getForm($model);
            }
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/antiCorruption/expertise'));
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                AcExpertise::model()->deleteByPk($id);
            }
        }
        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = AcExpertise::model()->findByPk($id);

        if ($model === null)
            throw new CHttpException(404, 'Данной страницы не существует.');

        return $model;
    }

    protected  function getForm($model) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $this->renderPartial('_form', array('model' => $model), false, true);
    }
}