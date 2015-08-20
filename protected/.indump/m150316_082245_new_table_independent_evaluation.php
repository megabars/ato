<?php

class m150316_082245_new_table_independent_evaluation extends CDbMigration
{
    public function down()
    {
        $this->dropTable('independent_evaluation');
    }

    public function safeUp()
    {
        $this->createTable('independent_evaluation', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'link'=>'varchar(500)',
            'portal_group_id'=>'integer',
            'executive_id'=>'integer',
        ));
    }
}