<?php

class ScheduleController extends AdminController
{
    public function actionIndex()
    {
        Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        CJuiDateTimePicker::registerScripts();

        $model = new AppealSchedule('search');

        $model->unsetAttributes();

        if (isset($_GET['AppealSchedule'])) {
            $model->attributes = $_GET['AppealSchedule'];
        }

        $grid = Yii::app()->controller->isMainPortal() ? '_grid' : 'subportal/_grid';

        $this->render('index', array(
            'model' => $model,
            'grid' => $grid,
        ));
    }

    public function actionSave($id=null)
    {
        $model = ($id == null) ? new AppealSchedule : $this->loadModel($id);

        if (isset($_POST['AppealSchedule'])){
            $model->setAttributes($_POST['AppealSchedule'], false);

            if(isset($_POST['AppealSchedule']['days']))
                $model->week_days = serialize($_POST['AppealSchedule']['days']);

            if (!$model->save())
                throw new CHttpException(500, print_r($model->getErrors(), true));
        } else { // отдаем заполненную форму
            $this->getForm($model);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/appeal/schedule'));
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
        $model = AppealSchedule::model()->findByPk($id);

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

        $model->date = date('Y-m-d', strtotime($model->date));
        $model->time_start = date('H:i', strtotime($model->time_start));
        $model->time_end = date('H:i', strtotime($model->time_end));

        $fields = Yii::app()->controller->isMainPortal() ? '_fields' : 'subportal/_fields';

        $this->renderPartial('form', array(
            'model' => $model,
            'fields' => $fields,
        ), false, true);
    }
}