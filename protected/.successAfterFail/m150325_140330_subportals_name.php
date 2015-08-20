<?php

class m150325_140330_subportals_name extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150325_140330_subportals_name does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        foreach (Portal::model()->findAll('id != 1') as $portal) {
            $portal->title = str_replace('Томской области', '', $portal->title);
            $portal->save();
        }

	}
    /*
    public function safeDown()
    {
    }
    */
}