<?php

class m150403_125312_file_origin_name_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('file', 'origin_name', 'text');
	}

	public function down()
	{
		echo "m150403_125312_file_origin_name_len does not support migration down.\n";
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