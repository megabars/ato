<?php

class m150227_134438_new_table_comments extends CDbMigration
{
    public function down()
    {
        $this->dropTable('comments');
    }

    public function safeUp()
    {
        $this->createTable('comments', array(
            'owner_name'=>'varchar(50)',
            'owner_id'=>'integer',
            'comment_id'=>'serial NOT NULL PRIMARY KEY',
            'parent_comment_id'=>'integer',
            'creator_id'=>'integer',
            'user_name'=>'varchar(255)',
            'user_email'=>'varchar(255)',
            'comment_text'=>'text',
            'create_time'=>'integer',
            'update_time'=>'integer',
            'status'=>'integer',
        ));
    }
}