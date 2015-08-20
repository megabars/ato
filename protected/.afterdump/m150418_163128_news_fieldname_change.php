<?php

class m150418_163128_news_fieldname_change extends CDbMigration
{
	public function up()
	{
        $this->renameColumn('news', 'video_gallery_id', 'video_id');
	}

	public function down()
	{
		echo "m150418_163128_news_fieldname_change does not support migration down.\n";
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