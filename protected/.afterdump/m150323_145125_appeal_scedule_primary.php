<?php

class m150323_145125_appeal_scedule_primary extends CDbMigration
{
	public function up()
	{
        $this->addPrimaryKey('appeal_schedule_pk', 'appeal_schedule', 'id');
	}

	public function down()
	{
		echo "m150323_145125_appeal_scedule_primary does not support migration down.\n";
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