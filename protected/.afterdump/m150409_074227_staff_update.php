<?php

class m150409_074227_staff_update extends CDbMigration
{
	public function up()
	{
        $this->addColumn('staff', 'contest_date', 'text');
        $this->addColumn('staff', 'paper', 'text');
        $this->addColumn('staff', 'org_address', 'text');
        $this->addColumn('staff', 'doc_address', 'text');
        $this->addColumn('staff', 'org_characteristic', 'text');
        $this->addColumn('staff', 'labor_condition', 'text');

        $this->addColumn('staff', 'type', 'int');
	}

	public function down()
	{
		echo "m150409_074227_staff_update does not support migration down.\n";
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