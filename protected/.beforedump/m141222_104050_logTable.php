<?php

class m141222_104050_logTable extends CDbMigration
{
//	public function up()
//	{
//	}

//	public function down()
//	{
//		echo "m141222_104050_logTable does not support migration down.\n";
//		return false;
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('log', array(
            'id'=>'serial',
            'changedModel'=>'varchar(50)',
            'typeOfChange'=>'varchar(50)',
            'userId' => 'integer',
            'date'=>'integer',
        ));
	}

    public function safeDown()
    {
        $this->dropTable('log');
    }
}