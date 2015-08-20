<?php

class m150321_103334_settings_portal_id_remove extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('settings_mail', 'portal_id');
	}

	public function down()
	{
		echo "m150321_103334_settings_portal_id_remove does not support migration down.\n";
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