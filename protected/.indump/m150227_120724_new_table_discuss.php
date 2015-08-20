<?php

class m150227_120724_new_table_discuss extends CDbMigration
{
    public function down()
    {
        $this->dropTable('discuss');
    }

    public function safeUp()
    {
        $this->createTable('discuss', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'title'=>'varchar(255)',
            'date_start'=>'integer',
            'date_finish'=>'integer',
            'date_publish'=>'integer',
            'description'=>'text',
            'file'=>'integer',
            'executive_id'=>'integer',
        ));
    }
}