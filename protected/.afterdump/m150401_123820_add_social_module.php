<?php

class m150401_123820_add_social_module extends CDbMigration
{
	public function up()
	{
        $this->createTable('social_networks', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'type'=>'text',
            'portal_id'=>'integer',
            'link'=>'text',
        ));
	}

	public function down()
	{
		$this->dropTable('social_networks');
		return false;
	}
}