<?php

class StaffCommand extends CConsoleCommand
{
    public function actionIndex()
    {
        foreach (Portal::model()->findAll() as $portal)
        {
            if ($staffNavMenu = NavMenu::model()->findByAttributes(array('portal_id' => $portal->id, 'alias' => 'services')))
            {
                if ($staffNavItem = NavItems::model()->findByAttributes(array('menuId' => $staffNavMenu->id, 'title' => 'Кадровая политика')))
                {
                    $items = array(
                        'Государственная гражданская служба' => array(
                            'Кадровый резерв' => '',
                            'Список лиц' => '',
                        ),
                        'Конкурсы' => array(
                            'Текущие конкурсы' => '',
                            'Итоги' => '',
                        ),
                        'Аттестации' => '',
                        'Комиссия' => '',
                        'Нормативные документы' => '',
                    );

                    foreach ($items as $item => $value)
                    {
                        $urlModel = new UrlManager();
                        $urlModel->portal_id = $portal->id;
                        $urlModel->url = str_replace(' ', '-', Transliterate::text($item));
                        $urlModel->title = $item;

                        if ($urlModel->save())
                        {
                            $mainModel = new NavItems();

                            $mainModel->attributes = array(
                                'title' => $item,
                                'parent_id' => $staffNavItem->id,
                                'menuId' => $staffNavItem->menuId,
                                'url_id' => $urlModel->id,
                                'state' => 1,
                                'is_link' => 1,
                                'is_deleted' => 0,
                            );

                            if ($mainModel->save() && is_array($value))
                            {
                                foreach ($value as $secondItem => $secondItemValue)
                                {
                                    $secondUrlModel = new UrlManager();
                                    $secondUrlModel->portal_id = $portal->id;
                                    $secondUrlModel->url = str_replace(' ', '-', Transliterate::text($secondItem));
                                    $secondUrlModel->title = $secondItem;

                                    if ($secondUrlModel->save())
                                    {
                                        $secondModel = new NavItems();

                                        $secondModel->attributes = array(
                                            'title' => $secondItem,
                                            'parent_id' => $mainModel->id,
                                            'menuId' => $staffNavItem->menuId,
                                            'url_id' => $secondUrlModel->id,
                                            'state' => 1,
                                            'is_link' => 1,
                                            'is_deleted' => 0,
                                        );

                                        $secondModel->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}