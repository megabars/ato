<?php

class m150417_090504_documents_title_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('documents', 'title', 'text');
	}

	public function down()
	{
		echo "m150417_090504_documents_title_len does not support migration down.\n";
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