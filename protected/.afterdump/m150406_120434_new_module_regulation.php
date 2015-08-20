<?php

class m150406_120434_new_module_regulation extends CDbMigration
{
	public function up()
	{
        $this->createTable('regulation', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id' => 'integer',
            'title' => 'varchar(500)',
            'preview' => 'text',
            'ordi' => 'integer',
            'note' => 'text',
            'date' => 'integer',
            'type' => 'varchar(500)',
            'public' => 'varchar(255)',
            'number' => 'varchar(500)',
            'file' => 'integer',
            'pdf' => 'integer',
            'doc' => 'integer',
            'zip' => 'integer',
            'change_date' => 'integer',
            'description' => 'text',
            'date_public' => 'integer',
            'date_real'  => 'integer',
        ));
	}

	public function down()
	{
        $this->dropTable('regulation');
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