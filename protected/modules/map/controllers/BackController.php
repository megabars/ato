<?php

class BackController extends AdminController
{
    protected $type;

    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        Yii::app()->clientScript->registerCoreScript('punycode');

        $model = new Maps('search');
        $model->unsetAttributes();

        if (isset($_GET['Maps']))
            $model->attributes = $_GET['Maps'];

        $this->render('index', array(
            'model' => $model->sorted('ASC'),
        ));
    }

    public function actionSave($id=null)
    {
        $model = $id == null ? new Maps : $this->loadModel($id);

        if (isset($_POST['Maps'])) {
            $model->setAttributes($_POST['Maps'], false);

            $this->performAjaxValidation($model);

            if (!$model->save())
                throw new CHttpException(500, print_r($model->getErrors(), true));
        } else {
            $this->getForm($model);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);
        $model->delete();

        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/map/back'));
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
        $model = Maps::model()->findByPk($id);

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

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'map-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }
}