<?php

class m150423_115653_people_local extends CDbMigration
{
	public function up()
	{
        $this->createTable("people_local", array(
            "id" => "pk",
            'portal_id' => 'int NOT NULL',
            "text" => "text NOT NULL",
        ));
	}

	public function down()
	{
		echo "m150423_115653_people_local does not support migration down.\n";
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