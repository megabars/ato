<?php

class m150303_110607_change_in_nav extends CDbMigration
{
	public function up()
	{
        $this->update('url_manager', array('url' => 'rating/front'), 'url = \'openregion/rating\'');

	}

	public function down()
	{
        $this->update('url_manager', array('url' => 'openregion/rating'), array('url' => 'rating/front'));
		return true;
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