<?php

class m150130_115202_new_menu_pages extends CDbMigration
{
//	public function up()
//	{
//	}

    public function down()
    {
        echo "m150130_115202_new_menu_pages does not support migration down.\n";
        return false;
    }

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        $mainMenu = NavMenu::model()->findByAttributes(array('alias' => 'main_menu'));

        foreach ($mainMenu->navItems as $item) {
            if ($item->parent_id == 1425) {

                $model = new StaticPage();

                $model->attributes = array(
                    'portal_id' => 1,
                    'title' => $item->title,
                    'url' => $item->url,
                    'state' => 1,
                    'description' => 'Страница ожидает наполнения...',
                    'preview' => 'Страница ожидает наполнения...',
                );

                if (!$model->save())
                    die($model->getErrors());

            }


        }
    }

    /*
	public function safeDown()
	{
	}
	*/
}