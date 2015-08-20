<?php

class ScheduleController extends AdminController
{
    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new AcSchedule('search');
        $model->unsetAttributes();

        if (isset($_GET['AcSchedule'])) {
            $model->attributes = $_GET['AcSchedule'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionSave($id=null)
    {
        if($id == null) {
            $model = new AcSchedule;

            if (isset($_POST['AcSchedule'])) {
                $model->setAttributes($_POST['AcSchedule'], false);
                $model->date = strtotime($model->date);

                if (!$model->save())
                    throw new CHttpException(500, 'Запись не создана');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['AcSchedule'])){
                $model->setAttributes($_POST['AcSchedule'], false);
                $model->date = strtotime($model->date);

                if (!$model->save())
                    throw new CHttpException(500, 'Запись не отредактирована');
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/antiCorruption/schedule'));
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

    public function loadModel($id)
    {
        $model = AcSchedule::model()->findByPk($id);

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