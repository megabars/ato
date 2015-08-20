<?php

class m150305_054700_news_social extends CDbMigration
{
	public function up()
	{
        $this->addColumn('news','social', 'integer default 1');
	}

	public function down()
	{
		echo "m150305_054700_news_social does not support migration down.\n";
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