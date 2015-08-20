<?php

class m150427_084742_add_column_npa extends CDbMigration
{
	public function up()
	{
        $this->addColumn('executive', 'npa', 'int');
	}

	public function down()
	{
		echo "m150427_084742_add_column_npa does not support migration down.\n";
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