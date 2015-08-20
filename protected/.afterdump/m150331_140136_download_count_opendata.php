<?php

class m150331_140136_download_count_opendata extends CDbMigration
{
	public function up()
	{
        $this->addColumn('opendata', 'download_count', 'int');
	}

	public function down()
	{
		echo "m150331_140136_download_count_opendata does not support migration down.\n";
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