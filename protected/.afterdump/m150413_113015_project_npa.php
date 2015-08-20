<?php

class m150413_113015_project_npa extends CDbMigration
{
	public function up()
	{
        $this->createTable('project_npa', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'title'=>'varchar(255)',
            'type'=>'varchar(255)',
            'date_actual'=>'integer',
            'date_finish'=>'integer',
            'date_publish'=>'integer',
            'file'=>'integer',
            'executive_id'=>'integer',
        ));
	}

	public function down()
	{
		$this->dropTable('project_npa');
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