<?php

class m150224_045832_new_table_public_report extends CDbMigration
{
    public function down()
    {
        $this->dropTable('public_report');
    }

    public function safeUp()
    {
        $this->createTable('public_report', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'date'=>'integer',
            'file'=>'integer',
            'type'=>'integer',
        ));
    }
}