<?php

class FileController extends AdminController
{
    protected $type;

    public function actionIndex($type=null)
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new AcFile('search');
        $model->unsetAttributes();

        $model->type = ($type==null) ? $this->type : $type;

        if (isset($_GET['AcFile']))
            $model->attributes = $_GET['AcFile'];

        $this->render('application.modules.antiCorruption.views.file.index', array(
            'model' => $model,
        ));
    }

    public function actionSave($id=null, $type=null)
    {
        if($id == null && $type != null) {
            $model = new AcFile;
            $model->type = $type;
            if (isset($_POST['AcFile'])) {
                $model->setAttributes($_POST['AcFile'], false);


                if (!$model->save())
                    throw new CHttpException(500, 'Файл не создан');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['AcFile'])){
                $model->setAttributes($_POST['AcFile'], false);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/antiCorruption/back'));
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
        $model = AcFile::model()->findByPk($id);

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

        $this->renderPartial('application.modules.antiCorruption.views.file._form', array('model' => $model), false, true);
    }
}