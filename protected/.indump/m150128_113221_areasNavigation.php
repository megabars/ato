<?php

class m150128_113221_areasNavigation extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150128_113221_areasNavigation does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $mainMenu = NavMenu::model()->findByAttributes(array('alias' => 'main_menu'));

        $addMenu = array(
            'nature_res' => 'Природные ресурсы',
            'history' => 'История',
            'social' => 'Социальная сфера',
            'scheme' => 'Схема территориального планирования',
        );




        foreach ($mainMenu->navItems as $item) {
            if ($item->id == 1425) {
                $item->url = 'adm';
                $item->save();
            }

            if ($item->parent_id == 1425) {

                // url - транслитирируем + левые символы из урл тоже надо выкинуть...
                $url = Transliterate::text($item->title);
                $url = preg_replace('/\W/s', '-', $url);

                $item->url = $url;

                if (!$item->save())
                    die(print_r($item->getErrors()));

                foreach ($addMenu as $partUrl => $name) {
                    $model = new NavItems();
                    $model->attributes = array(
                        'portal_id' => 1,
                        'menuId' => $item->menuId,
                        'title' => $name,
                        'url' => $url . '_' . $partUrl,
                        'parent_id' => $item->id,
                        'state' => 1
                    );



                    if (!$model->save())
                        die($model->getErrors());

                }


            }
        }


	}

    /*
    public function safeDown()
    {
    }
    */
}