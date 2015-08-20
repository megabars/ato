<?php

class m150424_074203_orv_portal_id extends CDbMigration
{
	public function up()
	{
        $this->addColumn('rating_doc', 'portal_id', 'int');
        $this->addColumn('rating_email', 'portal_id', 'int');
        $this->addColumn('rating_project_file', 'portal_id', 'int');
	}

	public function down()
	{
		echo "m150424_074203_orv_portal_id does not support migration down.\n";
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