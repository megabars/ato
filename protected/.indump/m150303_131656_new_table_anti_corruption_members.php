<?php

class m150303_131656_new_table_anti_corruption_members extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_members');
    }

    public function safeUp()
    {
        $this->createTable('ac_members', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'fio'=>'varchar(255)',
            'post'=>'varchar(500)',
        ));
    }
}