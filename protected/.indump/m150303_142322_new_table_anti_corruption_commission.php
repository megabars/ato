<?php

class m150303_142322_new_table_anti_corruption_commission extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_commission');
    }

    public function safeUp()
    {
        $this->createTable('ac_commission', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'decree'=>'text',
            'regulation'=>'text',
        ));
    }
}