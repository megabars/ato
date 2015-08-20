<?php

class m150316_081658_new_table_portal_group extends CDbMigration
{
    public function down()
    {
        $this->dropTable('portal_group');
    }

    public function safeUp()
    {
        $this->createTable('portal_group', array(
            'id'=>'serial NOT NULL PRIMARY KEY',
            'name'=>'varchar(500)',
        ));

        $this->insert('portal_group', array('name' => 'Образование'));
        $this->insert('portal_group', array('name' => 'Культура'));
        $this->insert('portal_group', array('name' => 'Физическая культура и спорт'));
        $this->insert('portal_group', array('name' => 'Здравоохранение'));
        $this->insert('portal_group', array('name' => 'Социальное обслуживание'));
    }
}