<?php

class m150427_113403_forms_table extends CDbMigration
{
	public function up()
	{
        $this->createTable("forms", array(
            "id" => "pk",
            "portal_id" => "int",
            "service" => "text",
            'file' => "int",
        ));
	}

	public function down()
	{
		echo "m150427_113403_forms_table does not support migration down.\n";
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