<?php

class m150507_111712_create_expert_settings extends CDbMigration
{
	public function up()
	{
		if (Yii::app()->db->schema->getTable("expert_settings",true)!==null)
				$this->dropTable("expert_settings"); 
		$this->createTable("expert_settings", array(
            "id" => "pk",
            "message" => "text",
            "isActive" => "bool"
        ));
	}

	public function down()
	{
		echo "m150507_111712_create_expert_settings does not support migration down.\n";
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