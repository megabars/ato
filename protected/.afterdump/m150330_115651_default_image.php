<?php

class m150330_115651_default_image extends CDbMigration
{
	public function up()
	{
        $this->addColumn('news', 'default_image', 'int');
	}

	public function down()
	{
		echo "m150330_115651_default_image does not support migration down.\n";
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