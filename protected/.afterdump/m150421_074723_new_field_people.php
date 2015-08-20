<?php

class m150421_074723_new_field_people extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('people', 'order', 'integer');
	}
	public function safeDown()
	{
		$this->dropColumn('people', 'order');
	}
}