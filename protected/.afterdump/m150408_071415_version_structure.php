<?php

class m150408_071415_version_structure extends CDbMigration
{
	public function up()
	{
        $this->addColumn('opendata_version', 'structure_file', 'int');
	}

	public function down()
	{
		echo "m150408_071415_version_structure does not support migration down.\n";
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