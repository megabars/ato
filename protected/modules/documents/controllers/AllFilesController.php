<?php

class AllFilesController extends AdminController
{
    public function actionIndex()
    {

        $pages = StaticPage::model()->published()->findAll();

        $users = User::model()->findAll();

        $model = new Documents('search');

        $model->unsetAttributes();

        if (isset($_GET['Documents']))
        {
            $model->attributes = $_GET['Documents'];
        }

        $this->render('index', array(
            'model' => $model,
            'pages' => $pages,
            'users' => $users,
        ));
    }

//    public function actionCreate($group_id = null)
//    {
//        $model = new Documents;
//
//        $cs = Yii::app()->getClientScript();
//
//        $cs->scriptMap = array(
//            '*.js' => false,
//            '*.css' => false
//        );
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['Documents'])) {
//
//            $model->setAttributes($_POST['Documents'], false);
//            if (!$model->save()) {
//                throw new CHttpException(500, "Can't save document");
//            }
//
//        } else {
//            $this->renderPartial('_form', array(
//                'model' => $model,
//                'groupId' => $group_id
//            ), false, true);
//        }
//    }
//
//    public function actionUpdate($id)
//    {
//        $model = $this->loadModel($id);
//
//        // Uncomment the following line if AJAX validation is needed
//        // $this->performAjaxValidation($model);
//
//        if (isset($_POST['Documents']))
//        {
//
//            $model->setAttributes($_POST['Documents'], false);
//
//            if ($model->save())
//            {
//                $this->redirect($this->createUrl('/documents/file/index', array('folderId' => $model->folder_id)));
//            }
//        }
//
//        $this->render('update', array(
//            'model' => $model,
//        ));
//    }
//
//    public function actionDelete($id)
//    {
//        $this->loadModel($id)->delete();
//
//        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
//        if (!isset($_GET['ajax']))
//        {
//            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/documents/back'));
//        }
//    }
//
//    public function actionDeleteAll()
//    {
//        if (isset($_POST['ids']) && is_array($_POST['ids']))
//        {
//            foreach ($_POST['ids'] as $id)
//                Documents::model()->deleteByPk($id);
//        }
//
//        echo json_encode(true);
//    }
//
//    public function loadModel($id)
//    {
//        $model = Documents::model()->findByPk($id);
//
//        if ($model === null)
//        {
//            throw new CHttpException(404, 'Данной страницы не существует.');
//        }
//
//        return $model;
//    }
//
//    protected function performAjaxValidation($model)
//    {
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'documents-form')
//        {
//            echo CActiveForm::validate($model);
//
//            Yii::app()->end();
//        }
//    }
}