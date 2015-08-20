<?php

class m150303_113536_new_table_anti_corruption_expertise extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ac_expertise');
    }

    public function safeUp()
    {
        $this->createTable('ac_expertise', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'title'=>'varchar(500)',
            'file'=>'integer',
            'date_start'=>'integer',
            'date_finish'=>'integer',
            'date_publish'=>'integer',
            'executive_id'=>'integer',
            'description'=>'text'
        ));
    }
}