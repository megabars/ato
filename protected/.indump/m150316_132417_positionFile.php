<?php

class m150316_132417_positionFile extends CDbMigration
{
	public function down()
	{
		echo "m150316_132417_positionFile does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('people', 'positionFile', 'integer');
	}
}