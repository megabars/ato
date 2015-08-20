<?php

class m150303_115007_new_table_anti_corruption_public extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_public');
    }

    public function safeUp()
    {
        $this->createTable('ac_public', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'post_type_id'=>'integer',
            'fio'=>'varchar(255)',
            'post'=>'varchar(500)',
            'file'=>'integer',
            'year'=>'integer',
            'type'=>'integer',
        ));
    }
}