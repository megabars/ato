<?php

class m150304_160549_url_default_null extends CDbMigration
{
	public function up()
	{
//        $this->alterColumn('url_manager', 'url', 'VARCHAR(255) DROP NOT NULL');

        $this->dbConnection->createCommand('ALTER TABLE "url_manager" ALTER COLUMN "url" DROP NOT NULL')->execute();
	}

	public function down()
	{
		echo "m150304_160549_url_default_null does not support migration down.\n";
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