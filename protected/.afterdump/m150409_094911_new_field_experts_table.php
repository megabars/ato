<?php

class m150409_094911_new_field_experts_table extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('experts', 'post', 'varchar(500)');
    }
	public function safeDown()
	{
        $this->dropColumn('experts', 'post');
	}
}