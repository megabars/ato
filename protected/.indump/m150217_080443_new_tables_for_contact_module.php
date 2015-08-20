<?php

class m150217_080443_new_tables_for_contact_module extends CDbMigration
{
    public function down()
    {
        $this->dropTable('contact');
        $this->dropTable('contact_details');
    }

    public function safeUp()
    {
        $this->createTable('contact', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'title'=>'varchar(500)',
            'alias'=>'varchar(100)',
            'address'=>'varchar(500)',
            'photo'=>'integer',
            'driving_directions'=>'text',
            'description'=>'text',
        ));

        $this->createTable('contact_details', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'contact_id'=>'integer',
            'type'=>'integer',
            'value'=>'varchar(100)',
            'description'=>'text',
        ));

    }
}