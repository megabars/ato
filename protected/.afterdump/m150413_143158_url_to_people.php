<?php

class m150413_143158_url_to_people extends CDbMigration
{

	public function down()
	{
		echo "m150413_143158_url_to_people does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
        $this->addColumn('people', 'url', 'varchar(500)');
	}

}