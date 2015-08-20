<?php

class UpdateServiceMenuCommand extends CConsoleCommand
{
    public $possibleNames = array(
        'Обращения граждан'          => 4,
        'Кадровая политика'          => 5,
        'Противодействие коррупции'  => 6,
        'Открытые данные'            => 7,
        'Информационные системы'     => 8,
        'Проверки'                   => 9,
        'Статистика'                 => 10,
        'Аукционы и конкурсы'        => 11,
    );

    public function actionIndex()
    {
        foreach (Portal::model()->findAllByAttributes(array('theme' => 'iogv')) as $portal)
        {
            $transaction = Yii::app()->db->beginTransaction();

            $error = FALSE;

            $navMenuModel = new NavMenu();
            $navMenuModel->name = 'Сервисы';
            $navMenuModel->portal_id = $portal->id;
            $navMenuModel->alias = 'services';
            $navMenuModel->is_deleted = 0;

            if ($navMenuModel->save())
            {
                // Если сохранили новый тип меню "services"
                // Создаем пункты меню с названиями сервисов
                foreach ($this->possibleNames as $navItemTitle => $navItemValue)
                {
                    $urlManager = new UrlManager();
                    $urlManager->url = str_replace(' ', '-', Transliterate::text($navItemTitle));
                    $urlManager->portal_id = $portal->id;
                    $urlManager->title = $navItemTitle;

                    // Если сохранился новый url
                    if ($urlManager->save())
                    {
                        $navMenuItem = new NavItems();
                        $navMenuItem->title = $navItemTitle;
                        $navMenuItem->parent_id = 0;
                        $navMenuItem->state = 1;
                        $navMenuItem->menuId = $navMenuModel->id;
                        $navMenuItem->url_id = $urlManager->id;
                        $navMenuItem->is_deleted = 0;
                        $navMenuItem->is_link = 1;

                        // Если сохранился элемент меню, запускаем транзакцию
                        if (!$navMenuItem->save())
                        {
                            $error = 'navMenuItem';
                        }
                    }
                    else
                    {
                        $error = 'urlManager';
                    }
                }
            }
            else
            {
                $error = 'navMenuModel';
            }

            if ($error !== FALSE)
            {
                $transaction->rollback();

                echo "Could not save menu for portal {$portal->title}: {$error}\r\n";
            }
            else
            {
                $transaction->commit();
            }
        }
    }
}