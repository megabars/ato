<?php

class m150129_133131_office extends CDbMigration
{
	public function up()
	{
		$this->addColumn('people', 'office_type_id', 'int2 DEFAULT 0');
	}

	public function down()
	{
		echo "m150129_133131_office does not support migration down.\n";
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