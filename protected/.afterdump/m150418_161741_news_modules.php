<?php

class m150418_161741_news_modules extends CDbMigration
{
	public function up()
	{
        $this->addColumn('news','photo_gallery_id','integer default null');
        $this->addColumn('news','video_gallery_id','integer default null');
        $this->addColumn('news','links_group_id','integer default null');
        $this->addColumn('news','file_group_id','integer default null');
	}

	public function down()
	{
		echo "m150418_161741_news_modules does not support migration down.\n";
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