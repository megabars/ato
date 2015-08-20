<?php

class CommissionController extends AdminController
{
    public function actionIndex()
    {
        Yii::app()->clientScript->registerCoreScript('yiiactiveform');

        $model = AcCommission::model()->findByPk(1);
        $this->render('index', array(
            'model' => $model,
        ));
    }


    public function actionSave($id=null)
    {
        if($id == null) {
            $model = new AcCommission;

            if (isset($_POST['AcCommission'])) {
                $model->setAttributes($_POST['AcCommission'], false);
                $model->id=1; //защита от записи под другим id
                if (!$model->save())
                    throw new CHttpException(500, 'Запись не создана');
            } else {
                $this->getForm($model);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['AcCommission'])){
                $model->setAttributes($_POST['AcCommission'], false);
                if (!$model->save())
                    throw new CHttpException(500, 'Запись не отредактирована');
            } else { // отдаем заполненную форму
                $this->getForm($model);
            }
        }
    }

    public function loadModel($id)
    {
        $model = AcCommission::model()->findByPk($id);

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