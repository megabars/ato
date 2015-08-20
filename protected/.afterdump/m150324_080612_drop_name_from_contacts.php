<?php

class m150324_080612_drop_name_from_contacts extends CDbMigration
{
	public function up()
	{
        $this->dropColumn('contact', 'title');
	}

	public function down()
	{
		echo "m150324_080612_drop_name_from_contacts does not support migration down.\n";
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