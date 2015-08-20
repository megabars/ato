<?php

class NpaController extends AdminController
{
    public function actionIndex($folderId)
    {
        if (!$folder = DocumentsFolder::model()->findByPk($folderId))
            $this->errorTo('/documents/back', 'Не удалось найти альбом');

        Yii::app()->clientScript->registerCoreScript('yiiactiveform');
        FileUpload::registerScripts();

        $model = new Documents('search');

        $model->unsetAttributes();

        $model->folder_id = $folderId;
        if (isset($_GET['Documents'])) {
            $model->attributes = $_GET['Documents'];
        }

        $this->render('index', array(
            'model' => $model,
            'folder' => $folder,
        ));
    }

    public function actionSave($id=null, $folderId=null, $groupId=null)
    {
        if($id == null) {
            $model = new Documents;
            $model->setScenario('npa');

            if (isset($_POST['Documents'])) {
                $model->setAttributes($_POST['Documents'], false);
                $model->date_real = strtotime($model->date_real);
                $model->date_public = strtotime($model->date_public);

                if (!$model->save())
                    throw new CHttpException(500, 'Документ не создан');
            } else {
                $this->getForm($model, $folderId, $groupId);
            }
        } else {
            $model = $this->loadModel($id);
            if (isset($_POST['Documents'])){
                $model->setAttributes($_POST['Documents'], false);
                $model->date_real = strtotime($model->date_real);
                $model->date_public = strtotime($model->date_public);

                if (!$model->save())
                    throw new CHttpException(500, 'Документ не отредактирован');
            } else { // отдаем заполненную форму
                $this->getForm($model, $folderId, $groupId);
            }
        }
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
        {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/documents/back'));
        }
    }

    public function actionDeleteAll()
    {
        if (isset($_POST['ids']) && is_array($_POST['ids']))
        {
            foreach ($_POST['ids'] as $id)
                Documents::model()->deleteByPk($id);
        }

        echo json_encode(true);
    }

    public function loadModel($id)
    {
        $model = Documents::model()->findByPk($id);

        $model->setScenario('npa');

        if ($model === null) {
            throw new CHttpException(404, 'Данной страницы не существует.');
        }

        return $model;
    }

    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documents-form')
        {
            echo CActiveForm::validate($model);

            Yii::app()->end();
        }
    }

    protected  function getForm($model, $folderId, $groupId) {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
//            '*.js' => false,
            '*.css' => false,
            'back.js' => false,
            'ckeditor.js' => false,
            'ckfinder.js' => false,
            'fileuploader.js' => false,
            'jquery.js' => false,
            'jquery.yiiactiveform.js' => false,
        );

        if ($folderId !== null)
            $group = DocumentsFolder::model()->findByPk($folderId)->group;
        elseif ($groupId !== null)
            $group = FoldersGroup::model()->findByPk($groupId);
        else
            throw new CHttpException(500, 'Wrong function usage!');

        switch ($group->alias) {
            case 'protocols':
                $view = '_form_protocols';
                break;

            default:
                $view = '_form';
                break;
        }

        $this->renderPartial($view, array(
            'model' => $model,
            'folderId' => $folderId,
            'groupId' => $groupId), false, true);
    }
}