<?php

class m150320_152709_ducument_title_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('documents', 'title', 'TEXT');
	}

	public function down()
	{
		echo "m150320_152709_ducument_title_len does not support migration down.\n";
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