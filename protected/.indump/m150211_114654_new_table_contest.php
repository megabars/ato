<?php

class m150211_114654_new_table_contest extends CDbMigration
{
	public function up()
	{
		$this->createTable('contest', array(
			'id'				=>	'pk',
			'org'				=>	'varchar(255) NOT NULL',
			'title'				=>	'varchar(255) NOT NULL',
			'description_small'	=>	'varchar(500)',
			'description'		=>	'text',
			'date_start'		=>	'integer',
			'date_end'			=>	'integer',
			'date_placed'		=>	'integer',
			'file'				=>	'integer',
			'state'				=>	'integer NOT NULL DEFAULT 0',
		));
	}

	public function down()
	{
		$this->dropTable('contest');
	}
}
