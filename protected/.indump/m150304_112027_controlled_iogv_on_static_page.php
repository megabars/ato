<?php

class m150304_112027_controlled_iogv_on_static_page extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150304_112027_controlled_iogv_on_static_page does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('pageExecutives', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'page_id' => 'integer NOT NULL',
            'executive_id'=>'integer NOT NULL',
            'url'=>'varchar(255)',
        ));
	}

    /*
	public function safeDown()
	{
	}
	*/
}