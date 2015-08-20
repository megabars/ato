<?php

class m150416_142813_npa_title_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('project_npa', 'title', 'text');
	}

	public function down()
	{
		echo "m150416_142813_npa_title_len does not support migration down.\n";
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