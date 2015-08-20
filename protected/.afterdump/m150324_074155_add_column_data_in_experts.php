<?php

class m150324_074155_add_column_data_in_experts extends CDbMigration
{
	public function down()
	{
		echo "m150324_074155_add_column_data_in_experts does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('experts', 'date', 'integer');
	}
}