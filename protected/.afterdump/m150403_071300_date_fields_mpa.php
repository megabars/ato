<?php

class m150403_071300_date_fields_mpa extends CDbMigration
{
	public function up()
	{
        $this->addColumn('documents', 'date_real', 'int');
        $this->addColumn('documents', 'date_public', 'int');
	}

	public function down()
	{
		echo "m150403_071300_date_fields_mpa does not support migration down.\n";
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