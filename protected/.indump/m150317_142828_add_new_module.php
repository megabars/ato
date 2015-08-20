<?php

class m150317_142828_add_new_module extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('committee', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'name'=>'text',
            'description'=>'text',
        ));

        $this->createTable('committee_department', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'committee_id'=>'integer',
            'name'=>'text',
            'description'=>'text',
        ));

        $this->addForeignKey('committee_department_id', 'committee_department', 'committee_id', 'committee', 'id');

        $this->createTable('committee_staff', array(
            'id' => 'pk',
            'department_id' => 'integer',
            'photo'=>"int4 NULL",
            'full_name'=>"varchar(255) NULL",
            'contact_address'=>"varchar(255) NULL",
            'contact_phone'=>"varchar(255) NULL",
            'contact_fax'=>"varchar(255) NULL",
            'contact_site'=>"varchar(255) NULL",
            'contact_email'=>"varchar(255) NULL",
            'main_info'=>"text NULL",
            'life'=>"text NULL",
            'social_vk'=>"varchar(255) NULL",
            'social_tw'=>"varchar(255) NULL",
            'social_fb'=>"varchar(255) NULL",
        ));

        $this->addForeignKey('committee_department_id', 'committee_staff', 'department_id', 'committee_department', 'id');
	}

	public function safeDown()
	{
        $this->dropTable('committee_staff');
        $this->dropTable('committee_department');
        $this->dropTable('committee');
	}
}