<?php

class m150419_143130_smi_keyword extends CDbMigration
{
	public function up()
	{
        $this->addColumn('smi', 'keywords', 'text default null');
	}

	public function down()
	{
		echo "m150419_143130_smi_keyword does not support migration down.\n";
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