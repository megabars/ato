<?php

class m150320_083059_update_static_page_table_status_is_deleted extends CDbMigration
{
	public function up()
	{
        $this->update('static_page', array('is_deleted'=>BaseActiveRecord::STATUS_REMOVED), 'is_deleted!=0');
	}

	public function down()
	{
		echo "m150320_083059_update_static_page_table_status_is_deleted does not support migration down.\n";
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