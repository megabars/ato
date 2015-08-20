<?php

class m150217_124313_new_tables_for_rating extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('rating_doc', array(
			'id'				=>	'pk',
			'title'				=>	'varchar(500) NOT NULL',
			'author'			=>	'varchar(500)',
			'info'				=>	'varchar(500)',
			'global_type'		=>	'integer NOT NULL',
			'file'				=>	'integer',
			'type'				=>	'integer',
			'date'				=>	'integer NOT NULL',
		));


		$this->createTable('rating_project_file', array(
			'id'				=>	'pk',
			'title'				=>	'varchar(500) NOT NULL',
			'project_id'		=>	'integer NOT NULL',
			'ord'				=> 	'integer DEFAULT 100',
			'file'				=>	'integer NOT NULL',
			'description'		=>	'varchar(1000) NOT NULL',
		));

		$this->createTable('rating_email', array(
			'id'				=>	'pk',
			'fio'				=>	'varchar(500) NOT NULL',
			'phone'				=>	'integer NOT NULL',
			'email'				=>	'varchar(1000) NOT NULL',
			'info'				=>	'varchar(1000) NOT NULL',
		));
	}

	public function safeDown()
	{
		$this->dropTable('rating_project_file');
		$this->dropTable('rating_doc');
		$this->dropTable('rating_email');
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