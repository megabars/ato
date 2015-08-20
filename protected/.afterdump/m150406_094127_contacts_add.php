<?php

class m150406_094127_contacts_add extends CDbMigration
{
	public function down()
	{
		echo "m150406_094127_contacts_add does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('people', 'contact_photo', 'int');
		$this->addColumn('people', 'contact_name', 'varchar(500)');
		$this->addColumn('people', 'contact_description', 'varchar(500)');
	}
}