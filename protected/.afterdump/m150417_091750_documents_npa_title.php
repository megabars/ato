<?php

class m150417_091750_documents_npa_title extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('project_npa', 'title', 'text');
	}

	public function down()
	{
		echo "m150417_091750_documents_npa_title does not support migration down.\n";
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