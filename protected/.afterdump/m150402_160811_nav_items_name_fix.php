<?php

class m150402_160811_nav_items_name_fix extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150402_160811_nav_items_name_fix does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $c = 0;
        foreach (NavItems::model()->findAll("title like '%(по наличию)%'") as $i) {
            $i->title = trim(str_replace('(по наличию)', '', $i->title));
            if (!$i->save(false)) {
                print_r($i->getErrors());
                die;
            } else {
                $c++;
            }

        }

        echo "All dode. {$c} items saved\n";
	}
    /*

    public function safeDown()
    {
    }
    */
}