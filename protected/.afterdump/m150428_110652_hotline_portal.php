<?php

class m150428_110652_hotline_portal extends CDbMigration
{
	public function up()
	{
        $this->addColumn('hotlines', 'portal_id', 'int');
	}

	public function down()
	{
		echo "m150428_110652_hotline_portal does not support migration down.\n";
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