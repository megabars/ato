<?php

class m150415_081334_peopleStaff extends CDbMigration
{
	public function down()
	{
		echo "m150415_081334_peopleStaff does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{

        $this->addColumn('people_staff', 'main', 'int default 0');
	}
}