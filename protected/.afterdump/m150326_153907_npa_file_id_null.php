<?php

class m150326_153907_npa_file_id_null extends CDbMigration
{
	public function up()
	{
//        $this->alterColumn('documents', 'file', 'integer');
        $this->dbConnection->createCommand("ALTER TABLE documents ALTER COLUMN file DROP NOT NULL;")->execute();
	}

	public function down()
	{
		echo "m150326_153907_npa_file_id_null does not support migration down.\n";
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