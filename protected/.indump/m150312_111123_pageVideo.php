<?php

class m150312_111123_pageVideo extends CDbMigration
{
	public function up()
	{
        $this->addColumn('static_page', 'video_id', 'integer default null');

	}

	public function down()
	{
		echo "m150312_111123_pageVideo does not support migration down.\n";
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