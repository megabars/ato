<?php

class m150302_113416_new_table_anti_corruption_file extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_file');
    }

    public function safeUp()
    {
        $this->createTable('ac_file', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'title'=>'varchar(500)',
            'file'=>'integer',
            'type'=>'integer',
        ));
    }
}