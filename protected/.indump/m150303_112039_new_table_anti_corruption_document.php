<?php

class m150303_112039_new_table_anti_corruption_document extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_document');
    }

    public function safeUp()
    {
        $this->createTable('ac_document', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'title'=>'varchar(500)',
            'file'=>'integer',
            'type_id'=>'integer',
        ));
    }
}