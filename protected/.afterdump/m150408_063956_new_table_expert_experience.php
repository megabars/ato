<?php

class m150408_063956_new_table_expert_experience extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('expert_experience', array(
            'id' => 'pk',
            'expert_id'=>"integer NOT NULL",
            'period'=>"varchar(255) NOT NULL",
            'organization'=>"varchar(255)",
            'post'=>"varchar(255)",
            'is_deleted'=>"integer DEFAULT 0",
        ));
    }

    public function safeDown()
    {
        $this->dropTable('expert_experience');
    }
}