<?php

class m150316_084333_gallery_photos_fk extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('gallery_photo', 'photo_gallery_photos');
        $this->addForeignKey('gallery_photo', 'photo_gallery_photos', 'photo_gallery_id', 'photo_gallery', 'id', 'CASCADE', 'CASCADE');
	}

	public function down()
	{
		echo "m150316_084333_gallery_photos_fk does not support migration down.\n";
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