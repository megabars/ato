<?php

class m150227_120551_new_field_contact_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('contact', 'executive_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('contact', 'executive_id');
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