<?php

class m150213_125537_new_table_appeal_place extends CDbMigration
{
    public function down()
    {
        $this->dropTable('appeal_place');
    }

    public function safeUp()
    {

        $this->createTable('appeal_place', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'department'=>'varchar(500)',
            'address'=>'varchar(500)',
            'time'=>'varchar(500)',
            'head'=>'varchar(100)',
            'phone'=>'varchar(100)',
            'email'=>'varchar(100)',
            'description'=>'text',
        ));
    }
}