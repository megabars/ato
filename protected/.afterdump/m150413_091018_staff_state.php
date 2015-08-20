<?php

class m150413_091018_staff_state extends CDbMigration
{
	public function up()
	{
        $this->addColumn('staff', 'state', 'int');
	}

	public function down()
	{
		echo "m150413_091018_staff_state does not support migration down.\n";
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