<?php

class m150420_123356_npa_types extends CDbMigration
{
	public function up()
	{
        $cnt = DocumentsFolder::model()->deleteAllByAttributes(array('title' => 'орсмппапокав'));
        echo "{$cnt} items removed\n";
	}

	public function down()
	{
		echo "m150420_123356_npa_types does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}