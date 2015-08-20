<?php

class m150413_145704_staff_result_fields extends CDbMigration
{
	public function up()
	{
        $this->addColumn('staff', 'file', 'int');
        $this->addColumn('staff', 'result_file', 'int');
        $this->addColumn('staff', 'result', 'text');
	}

	public function down()
	{
		echo "m150413_145704_staff_result_fields does not support migration down.\n";
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