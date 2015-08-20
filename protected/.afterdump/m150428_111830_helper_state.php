<?php

class m150428_111830_helper_state extends CDbMigration
{
	public function up()
	{
        $this->addColumn('experts_helper', 'state', 'int');
	}

	public function down()
	{
		echo "m150428_111830_helper_state does not support migration down.\n";
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