<?php

class m150210_122316_new_table_news_subscribers extends CDbMigration
{
    public function down()
    {
        $this->dropTable('news_subscribers');
    }

    public function safeUp()
    {

        $this->createTable('news_subscribers', array(
            'id' => 'serial NOT NULL PRIMARY KEY',
            'portal_id'=>'integer',
            'subscriber'=>'varchar(500)',
            'email'=>'varchar(255)',
        ));
    }
}