<?php

class m150415_105428_vote_ip_field extends CDbMigration
{
	public function up()
	{
        $this->addColumn('vote_user', 'ip_address', 'varchar(255)');
        $this->dropColumn('vote_user', 'user_id');
	}

	public function down()
	{
		echo "m150415_105428_vote_ip_field does not support migration down.\n";
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