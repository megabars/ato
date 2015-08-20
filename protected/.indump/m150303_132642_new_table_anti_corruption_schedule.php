<?php

class m150303_132642_new_table_anti_corruption_schedule extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_schedule');
    }

    public function safeUp()
    {
        $this->createTable('ac_schedule', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'date'=>'integer',
            'description'=>'text',
        ));
    }
}