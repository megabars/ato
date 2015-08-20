<?php

class m150407_134208_date_feedback_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('feedback', 'date', 'int');
	}

	public function down()
	{
		echo "m150407_134208_date_feedback_field does not support migration down.\n";
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