<?php

class m150417_092009_documents_redulation_len extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('regulation', 'title', 'text');
	}

	public function down()
	{
		echo "m150417_092009_documents_redulation_len does not support migration down.\n";
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