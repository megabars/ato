<?php
/**
 * author: Mikhail Matveev
 * Date: 12.03.15 
 */

class PageVideoController extends AdminController {

    public function actionUse()
    {
        list ($videoId, $pageId, $instanceType) = array(
            $_GET['id'],
            $_GET['pageId'],
            $_GET['instanceType'],
        );

        $page = $instanceType::model()->findByPk($pageId);
        $page->video_id = $videoId;
        $page->save();
    }

    public function actionDelete($id, $pageId)
    {
        if ($page = StaticPage::model()->findByPk($pageId))
        {
            $page->video_id = null;

            $page->save();
        }
    }
}