<?php

class m150217_103456_staticPages extends CDbMigration
{
//	public function up()
//	{
//	}
//	public function down()
//	{
//		echo "m150217_103456_staticPages does not support migration down.\n";
//		return false;
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('url_manager', array(
            'id'				=>	'pk',
            'url'				=>	'varchar(255) NOT NULL',
            'portal_id'				=>	'int NOT NULL',
            'title'				=>	'varchar(255)',
            'meta_description'	=>	'varchar(500)',
            'meta_keywods'		=>	'varchar(500)',
        ));
	}

    public function safeDown()
    {
        $this->dropTable('url_manager');
    }
}