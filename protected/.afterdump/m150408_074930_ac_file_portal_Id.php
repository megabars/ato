<?php

class m150408_074930_ac_file_portal_Id extends CDbMigration
{
	public function up()
	{
        $this->addColumn('ac_file', 'portal_id', 'int');
	}

	public function down()
	{
		echo "m150408_074930_ac_file_portal_Id does not support migration down.\n";
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