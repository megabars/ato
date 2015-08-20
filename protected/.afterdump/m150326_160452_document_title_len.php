<?php

class m150326_160452_document_title_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('documents', 'title', 'text');
	}

	public function down()
	{
		echo "m150326_160452_document_title_len does not support migration down.\n";
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