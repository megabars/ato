<?php

class m150304_153916_news_url extends CDbMigration
{
	public function up()
	{
        $this->addColumn('news', 'url_id', 'integer default null');
	}

	public function down()
	{
		echo "m150304_153916_news_url does not support migration down.\n";
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