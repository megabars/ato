<?php

class m150415_110632_vote_close_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('vote', 'closed', 'int');
        $this->addColumn('vote', 'date_publish', 'int');
	}

	public function down()
	{
		echo "m150415_110632_vote_close_field does not support migration down.\n";
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