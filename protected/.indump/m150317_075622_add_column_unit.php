<?php

class m150317_075622_add_column_unit extends CDbMigration
{
	public function down()
	{
		echo "m150317_075622_add_column_unit does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('people_unit', 'content', 'text');
	}
}