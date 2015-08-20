<?php

class m150303_123428_video_gallery extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150303_123428_video_gallery does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('video_gallery', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer NOT NULL',
            'alias'=>'varchar(255)',
        ));

        $this->renameTable('video', 'video_gallery_videos');
        $this->addColumn('video_gallery_videos', 'video_gallery_id', 'integer');
	}

    /*
	public function safeDown()
	{
	}
	*/
}