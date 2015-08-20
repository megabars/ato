<?php

class m150130_151016_new_field_afisha extends CDbMigration
{
	public function up()
	{
        $this->addColumn('afisha', 'participant', 'varchar(255)');
	}

	public function down()
	{
		echo "m150130_151016_new_field_afisha does not support migration down.\n";
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