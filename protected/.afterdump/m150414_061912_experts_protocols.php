<?php

class m150414_061912_experts_protocols extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150414_061912_experts_protocols does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('expert_protocols', array(
            'id' => 'pk',
            'date'=>"integer NOT NULL",
            'type'=>"varchar(255)",
            'number'=>"varchar(255)",
            'file_id'=>"integer NOT NULL",
            'is_deleted'=>"integer DEFAULT 0",
        ));

        $this->createTable('expert_protocols_authors', array(
            'id' => 'pk',
            'protocol_id' => 'integer not null',
            'expert_adviser_id' => 'integer not null',
        ));

        $this->createTable('experts_helper', array(
            'id' => 'pk',
            'name' => 'text not null'
        ));
	}
    /*
    public function safeDown()
    {
    }
    */
}