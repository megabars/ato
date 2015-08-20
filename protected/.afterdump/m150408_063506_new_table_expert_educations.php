<?php

class m150408_063506_new_table_expert_educations extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('expert_educations', array(
            'id' => 'pk',
            'expert_id'=>"integer NOT NULL",
            'year'=>"varchar(50) NOT NULL",
            'specialty'=>"varchar(255)",
            'institution'=>"varchar(255)",
            'additional'=>"varchar(500)",
            'is_deleted'=>"integer DEFAULT 0",
        ));
    }

    public function safeDown()
    {
        $this->dropTable('expert_educations');
    }
}