<?php

class m141222_111251_updateLog extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m141222_111251_updateLog does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addPrimaryKey('pk_id', 'log', 'id');
	}
    /*

    public function safeDown()
    {
    }
    */
}