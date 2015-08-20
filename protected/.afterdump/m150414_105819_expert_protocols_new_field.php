<?php

class m150414_105819_expert_protocols_new_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('expert_protocols', 'descr', 'text default null');
	}

	public function down()
	{
		echo "m150414_105819_expert_protocols_new_field does not support migration down.\n";
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