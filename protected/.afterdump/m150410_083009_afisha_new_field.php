<?php

class m150410_083009_afisha_new_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('afisha', 'floor', 'varchar(255) default null');
	}

	public function down()
	{
		echo "m150410_083009_afisha_new_field does not support migration down.\n";
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