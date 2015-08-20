<?php

class m150402_145922_nav_menu_change extends CDbMigration
{

	public function down()
	{
		echo "m150402_145922_nav_menu_change does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dropColumn('nav_menu', 'name');
        $this->addColumn('nav_menu', 'published', 'integer default 0');

        foreach (NavMenu::model()->findAll() as $menu){
            if ($menu->alias != 'right_menu') {
                $menu->published = 1;
                if (!$menu->save()) {
                    print_r($menu->getErrors());
                    die;
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