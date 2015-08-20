<?php

class m150330_131107_add_support_emails extends CDbMigration
{
	public function up()
	{
        $this->addColumn('settings_mail', 'support_addr_1', 'VARCHAR(255) default null');
        $this->addColumn('settings_mail', 'support_addr_2', 'VARCHAR(255) default null');
	}

	public function down()
	{
		echo "m150330_131107_add_support_emails does not support migration down.\n";
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