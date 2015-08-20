<?php

class m150507_090933_static_page_access extends CDbMigration
{
	public function up()
	{
        $this->createTable("static_page_access", array(
            "id" => "pk",
            "usr_portal_id" => "int",
            "rule" => "text",
        ));
	}

	public function down()
	{
		echo "m150507_090933_static_page_access does not support migration down.\n";
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