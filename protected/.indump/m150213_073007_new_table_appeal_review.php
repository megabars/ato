<?php

class m150213_073007_new_table_appeal_review extends CDbMigration
{
    public function down()
    {
        $this->dropTable('appeal_review');
    }

    public function safeUp()
    {

        $this->createTable('appeal_review', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'file_id'=>'integer',
            'year'=>'varchar(100)',
            'description'=>'text',
        ));
    }
}