<?php

class m150408_062936_new_table_expert_resources extends CDbMigration
{
    public function safeUp()
    {
        // удаляем текущую
        $this->dropTable('experts_resources');

        //создаем новую версию
        $this->createTable('expert_resources', array(
            'id' => 'pk',
            'expert_id'=>"integer NOT NULL",
            'type'=>"integer NOT NULL",
            'value'=>"varchar(255) NOT NULL",
            'is_deleted'=>"integer DEFAULT 0",
        ));
    }

    public function safeDown()
    {
        // удаляем текущую
        $this->dropTable('expert_resources');

        //восстанавливаем предыдущую версию
        $this->createTable('experts_resources', array(
            'id' => 'pk',
            'experts_id'=>"integer",
            'type'=>"int2",
            'url'=>"varchar(255)",
            'is_deleted'=>"integer DEFAULT 0",
        ));
    }
}