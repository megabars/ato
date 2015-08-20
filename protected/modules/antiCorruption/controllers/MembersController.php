<?php

class MembersController extends AdminController
{
    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new AcMembers('search');

        $model->unsetAttributes();

        if (isset($_GET['AcMembers'])) {
            $model->attributes = $_GET['AcMembers'];
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionSave($id=null)
    {
        if($id == null) {
            $model = new AcMembers;

            if (isset($_POST['AcMembers'])) {
                $model->setAttributes($_POST['AcMembers'], false);

                if (!$model->save())
                    throw new CHttpException(500, 'Запись не создана');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['AcMembers'])){
                $model->setAttributes($_POST['AcMembers'], false);

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/antiCorruption/members'));
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
        $model = AcMembers::model()->findByPk($id);

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