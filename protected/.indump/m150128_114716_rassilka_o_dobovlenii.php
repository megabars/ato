<?php

class m150128_114716_rassilka_o_dobovlenii extends CDbMigration
{
	public function up()
	{
		//$this->alterColumn('log', 'date', 'int8');
		$this->addColumn('mail_email_list', 'is_alert', 'int2 DEFAULT 0');
	}

	public function down()
	{
		echo "m150128_114716_rassilka_o_dobovlenii does not support migration down.\n";
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