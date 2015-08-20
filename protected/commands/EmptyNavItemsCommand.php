<?php

class EmptyNavItemsCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        foreach (NavItems::model()->findAll() as $item)
        {
            if (!$page = StaticPage::model()->findByAttributes(array('url_id' => $item->url_id)))
            {
                if (!empty($item->menu->portal_id))
                {
                    $page = new StaticPage();
                    $page->portal_id = $item->menu->portal_id;
                    $page->title = $item->title;
                    $page->state = 1;
                    $page->is_deleted = 0;
                    $page->url_id = $item->url_id;
                    $page->date = time();
                    $page->type_id = 0;

                    $page->save();
                }
            }
            elseif ($page->state == 0 && $page->porta_id)
            {
                $page->state = 1;
                $page->save();
            }
        }
    }
}