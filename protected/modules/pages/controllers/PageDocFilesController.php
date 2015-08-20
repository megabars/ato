<?php
/**
 * author: Mikhail Matveev
 * Date: 25.02.15 
 */

Yii::import('application.modules.documents.controllers.FileController');

class PageDocFilesController extends FileController {

    public function actionIndex($folderId)
    {
        $cs = Yii::app()->getClientScript();

        $cs->scriptMap = array(
            '*.js' => false,
            '*.css' => false
        );

        if (!$folder = DocumentsFolder::model()->findByPk($folderId))
            $this->errorTo('/documents/back', 'Не удалось найти альбом');


        $model = new Documents('search');

        $model->unsetAttributes();

        $model->folder_id = $folderId;
        if (isset($_GET['Documents']))
        {
            $model->attributes = $_GET['Documents'];
        }

        $this->renderPartial('index', array(
            'model' => $model,
            'folder' => $folder,
        ), false, true);
    }


    public function actionDelete($id) {
        parent::actionDelete($id);
    }

    public function actionCreate($group_id = null) {
        parent::actionSave(null, null, $group_id);
    }
}