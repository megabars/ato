<?php

class m150427_123501_systems_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("systems", array(
            "id" => "pk",
            "portal_id" => "int",
            "service" => "text",
        ));
	}

	public function down()
	{
		echo "m150427_123501_systems_table does not support migration down.\n";
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