<?php

class m150304_171046_opendata_view_count extends CDbMigration
{
	public function up()
	{
        $this->addColumn('opendata', 'view_count', 'integer default 0');
	}

	public function down()
	{
		echo "m150304_171046_opendata_view_count does not support migration down.\n";
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