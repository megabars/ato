<?php

class m150306_120348_change_table_vote_item extends CDbMigration
{
	public function up()
	{
        $this->dropForeignKey('vote_item','vote_item');
	}

	public function down()
	{

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