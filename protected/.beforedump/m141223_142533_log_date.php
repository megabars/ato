<?php

class m141223_142533_log_date extends CDbMigration
{
	public function down()
	{
		echo "m141223_142533_log_date does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('people','date','character varying(255)');
		$this->addColumn('people_staff','date','character varying(255)');
	}
}