<?php

class m150310_121905_static_update_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('static_page', 'modify', 'integer default null');
        $this->addColumn('news', 'modify', 'integer default null');


	}

	public function down()
	{
		echo "m150310_121905_static_update_field does not support migration down.\n";
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