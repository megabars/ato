<?php

class m150129_063402_new_table_afisha_conf extends CDbMigration
{

	public function down()
	{
        $this->dropTable('afisha_conf');
	}

    public function safeUp()
    {

        $this->createTable('afisha_conf', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'month_file'=>'integer',
            'quarter_file'=>'integer',
            'year_file'=>'integer',
        ));
    }
}