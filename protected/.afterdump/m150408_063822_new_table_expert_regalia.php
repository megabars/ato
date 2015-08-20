<?php

class m150408_063822_new_table_expert_regalia extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('expert_regalia', array(
            'id' => 'pk',
            'expert_id'=>"integer NOT NULL",
            'type'=>"integer NOT NULL",
            'year'=>"varchar(50) NOT NULL",
            'name'=>"varchar(255)",
            'document'=>"varchar(255)",
            'is_deleted'=>"integer DEFAULT 0",
        ));
    }

    public function safeDown()
    {
        $this->dropTable('expert_regalia');
    }
}