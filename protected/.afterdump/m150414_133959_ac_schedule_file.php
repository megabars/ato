<?php

class m150414_133959_ac_schedule_file extends CDbMigration
{
	public function up()
	{
        $this->addColumn('ac_schedule', 'file', 'int');
	}

	public function down()
	{
		echo "m150414_133959_ac_schedule_file does not support migration down.\n";
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