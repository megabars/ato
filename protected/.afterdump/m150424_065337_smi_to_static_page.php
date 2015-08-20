<?php

class m150424_065337_smi_to_static_page extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('smi','social', 'integer default 1');
		$this->addColumn('smi','url_id','integer default null');
		$this->addColumn('smi','photo_gallery_id','integer default null');
		$this->addColumn('smi','video_id','integer default null');
		$this->addColumn('smi','links_group_id','integer default null');
		$this->addColumn('smi','file_group_id','integer default null');
		$this->dropColumn('smi','keywords');
	}

	public function safeDown()
	{
		$this->dropColumn('smi','social');
		$this->dropColumn('smi','url_id');
		$this->dropColumn('smi','photo_gallery_id');
		$this->dropColumn('smi','video_id');
		$this->dropColumn('smi','links_group_id');
		$this->dropColumn('smi','file_group_id');
		$this->addColumn('smi','keywords','varchar(500)');
	}
}