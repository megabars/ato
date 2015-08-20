<?php
/**
 * author: Mikhail Matveev
 * Date: 25.02.15 
 */

Yii::import('application.modules.documents.controllers.BackController');

class PageDocumentsController extends BackController {

    public function actionCreate($group_id = null) {
        parent::actionCreate($group_id);
    }
}