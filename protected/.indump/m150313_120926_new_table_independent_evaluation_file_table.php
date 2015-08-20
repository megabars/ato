<?php

class m150313_120926_new_table_independent_evaluation_file_table extends CDbMigration
{
    public function down()
    {
        $this->dropTable('ie_file');
    }

    public function safeUp()
    {
        $this->createTable('ie_file', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'title'=>'varchar(500)',
            'description'=>'text',
            'file'=>'integer',
            'file_type'=>'integer',
            'date'=>'integer',
            'doc_type'=>'integer',
        ));
    }
}