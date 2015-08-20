<?php

class FileController extends AdminController
{
    protected $type;

    public function actionIndex($type=null)
    {
        Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        CJuiDateTimePicker::registerScripts();
        FileUpload::registerScripts();

        $model = new IeFile('search');
        $model->unsetAttributes();

        $model->file_type = ($type==null) ? $this->type : $type;

        if (isset($_GET['IeFile']))
            $model->attributes = $_GET['IeFile'];

        $this->render('application.modules.independentEvaluation.views.file.index', array(
            'model' => $model,
        ));
    }

    public function actionSave($id=null, $type=null)
    {
        if($id == null && $type != null) {
            $model = new IeFile;
            $model->file_type = $type;
            if (isset($_POST['IeFile'])) {
                $model->setAttributes($_POST['IeFile'], false);

                if (!$model->save())
                    throw new CHttpException(500, 'Файл не создан');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['IeFile'])){
                $model->setAttributes($_POST['IeFile'], false);

                if (!$model->save())
                    throw new CHttpException(500, 'Файл не отредактирован');
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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/independentEvaluation/back'));
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
        $model = IeFile::model()->findByPk($id);

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

        $this->renderPartial('application.modules.independentEvaluation.views.file._form', array('model' => $model), false, true);
    }
}