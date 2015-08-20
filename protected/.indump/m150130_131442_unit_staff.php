<?php

class m150130_131442_unit_staff extends CDbMigration
{
	public function up()
	{
		$this->addColumn('people_staff', 'unit_id', 'int2 DEFAULT 0');
	}

	public function down()
	{
		echo "m150130_131442_unit_staff does not support migration down.\n";
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