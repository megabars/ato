<?php

class m150310_052116_rename_table_reception_schedule extends CDbMigration
{
	public function up()
	{
        $this->renameTable('reception_schedule', 'appeal_schedule');
	}

	public function down()
	{
        $this->renameTable('appeal_schedule', 'reception_schedule');
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