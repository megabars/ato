<?php

class m150225_074130_new_field_file_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('file', 'user_id', 'integer');
    }

	public function down()
	{
        $this->dropColumn('file', 'user_id');
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