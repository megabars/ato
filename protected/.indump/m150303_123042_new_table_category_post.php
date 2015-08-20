<?php

class m150303_123042_new_table_category_post extends CDbMigration
{
    public function down()
    {
        $this->dropTable('category_post');
    }

    public function safeUp()
    {

        $this->createTable('category_post', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'name'=>'varchar(500)',
        ));

        $this->insert('category_post', array('name' => 'Губернатор Томской области'));
        $this->insert('category_post', array('name' => 'Заместители Губернатора Томской области'));
        $this->insert('category_post', array('name' => 'Государственные гражданские служащие Томской области - руководители исполнительных органов государственной власти Томской области'));
        $this->insert('category_post', array('name' => 'Государственные гражданские служащие Томской области категории "Руководители", состоящие в штате Администрации Томской области'));
        $this->insert('category_post', array('name' => 'Государственные гражданские служащие Томской области категории "Помощники (советники)", состоящие в штате Администрации Томской области'));
        $this->insert('category_post', array('name' => 'Государственные гражданские служащие Томской области категории "Специалисты", состоящие в штате Администрации Томской области'));
    }
}