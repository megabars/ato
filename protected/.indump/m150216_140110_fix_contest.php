<?php

class m150216_140110_fix_contest extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('contest', 'org', 'varchar(500)');
		$this->alterColumn('contest', 'title', 'varchar(500)');
		$this->alterColumn('contest', 'description_small', 'varchar(1000)');
	}

	public function down()
	{
		$this->alterColumn('contest', 'org', 'varchar(250)');
		$this->alterColumn('contest', 'title', 'varchar(250)');
		$this->alterColumn('contest', 'description_small', 'varchar(500)');

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