<?php

class m150513_142757_people_group extends CDbMigration
{
	public function down()
	{
		echo "m150513_142757_people_group does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
        $this->createTable('people_group', array(
            "id" => "pk",
            'group_id'=>"int",
            'title'=>"text",
            'sort'=>"int",
        ));
	}
}