<?php

class m150408_052147_change_experts_table extends CDbMigration
{
	public function safeUp()
	{
        // удаляем текущую
        $this->dropTable('experts');

        //создаем новую версию
        $this->createTable('experts', array(
            'id' => 'pk',
            'state'=>"integer NOT NULL",
            'date'=>"integer NOT NULL",
            'expert_council_id'=>"integer NOT NULL",
            'fio'=>"varchar(255) NOT NULL",
            'birthday'=>"integer NOT NULL",
            'citizenship'=>"varchar(255) NOT NULL",
            'address'=>"varchar(500)",
            'restriction'=>"integer NOT NULL",
            'photo'=>"integer",
            'degree'=>"integer NOT NULL",
            'academic'=>"integer NOT NULL",
            'honorary'=>"integer NOT NULL",
            'publishing_count'=>"integer",
            'publishing'=>"text",
            'professional_interests'=>"text",
            'skill'=>"text NOT NULL",
            'achievements'=>"text",
            'prospect'=>"text",
            'public_organization'=>"text",
            'expert_work'=>"text",
            'wish'=>"text",
            'project'=>"text",
            'qualification'=>"text",
            'additional_information'=>"text",
            'is_deleted'=>"integer DEFAULT 0",
        ));
	}

	public function safeDown()
	{
        // удаляем текущую
        $this->dropTable('experts');

        //восстанавливаем предыдущую версию
        $this->createTable('experts', array(
            'id' => 'pk',
            'portal_id'=>"integer",
            'type'=>"integer",
            'fio'=>"varchar(255)",
            'phone'=>"varchar(255)",
            'email'=>"varchar(255)",
            'contact_address'=>"varchar(255)",
            'skills'=>"varchar(255)",
            'education'=>"varchar(255)",
            'scientific'=>"varchar(255)",
            'profession_skill'=>"text",
            'history'=>"text",
            'sovet_id'=>"integer",
            'experience'=>"text",
            'is_deleted'=>"integer DEFAULT 0",
            'date'=>"integer",
        ));
	}
}