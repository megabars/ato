<?php

class m150116_111854_new_field_in_opendata extends CDbMigration
{
	public function up()
	{
        $this->addColumn('opendata', 'period', 'varchar(255)');
	}

	public function down()
	{
		echo "m150116_111854_new_field_in_opendata does not support migration down.\n";
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