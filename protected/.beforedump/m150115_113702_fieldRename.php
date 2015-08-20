<?php

class m150115_113702_fieldRename extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('page', 'photo', 'file_id');
	}

	public function down()
	{
//		echo "m150115_113702_fieldRename does not support migration down.\n";
        $this->renameColumn('page', 'file_id', 'photo');
        return true;
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