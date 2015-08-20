<?php

class BackController extends AdminController
{
    public function actionIndex($alias = 'main')
    {
        $model = new DocumentsFolder('search');

        $model->unsetAttributes();

        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        // в самом модуле выводить только ссылки с главное страницы
        $group = FoldersGroup::model()->findByAttributes(array('alias' => $alias));
        if ($group !== null) {
            $model->group_id = $group->id;
        } else {
            $group = new FoldersGroup();
            $group->unsetAttributes();
            $group->alias = $alias;
            $group->name = 'auto_generated_'.$alias;
            $group->save();
        }

        if (isset($_GET['DocumentsFolder'])) {
            $model->attributes = $_GET['DocumentsFolder'];
        }

        $this->render('index', array(
            'model' => $model,
            'group' => $group,
        ));
    }

    public function actionCreate($group_id = null)
    {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        $model = new DocumentsFolder();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DocumentsFolder'])) {

            $model->setAttributes($_POST['DocumentsFolder'], false);

            if (!$model->save()) {
//                $this->redirect(array('index'));
                throw new CHttpException(500, 'Cant\'t save folder!');
            }
        } else {
            $model->group_id = $group_id;
            $this->renderPartial('_form', array(
                'model' => $model
            ), false, true);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['DocumentsFolder'])) {

            $model->setAttributes($_POST['DocumentsFolder'], false);

            if (!$model->save()) {
                throw new CHttpException(500, "Can't save model");
            }

        } else {
            $this->renderPartial('_form', array(
                'model' => $model,
            ), false, true);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        foreach ($model->documents as $doc) {
            $doc->delete();
        }

        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/documents/back/index'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids'])) {
            foreach ($_POST['ids'] as $id) {
                $_GET['ajax'] = false;
                $this->actionDelete($id);
            }
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = DocumentsFolder::model()->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documents-folder-form') {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    /**
     * @todo не работает нормально, переделать на drag-n-drop
     * @param $id
     * @param $action
     */
    public function actionOrder($id, $action)
    {
        $model = $this->loadModel($id);

        if ($action == 'up') {
            $ordi = $model->ordi + 1;
        } else {
            $ordi = $model->ordi - 1;
        }

        $criteria = new CDbCriteria();
        $criteria->addCondition("ordi = {$ordi}");

        if ($swappedRecord = DocumentsFolder::model()->find($criteria)) {
            if ($action == 'up') {
                $swappedRecord->ordi = $ordi - 1;
            } else {
                $swappedRecord->ordi = $ordi + 1;
            }

            $model->ordi = $ordi;

            $model->save();
            $swappedRecord->save();
        }

        $this->redirect(array('/documents/back'));
    }
}