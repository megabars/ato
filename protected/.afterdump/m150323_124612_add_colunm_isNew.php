<?php

class m150323_124612_add_colunm_isNew extends CDbMigration
{
	public function down()
	{
		echo "m150323_124612_add_colunm_isNew does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->addColumn('feedback', 'new', 'integer default 1');
	}
}