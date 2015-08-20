<?php

class m150306_122051_change_table_vote extends CDbMigration
{
    public function up()
    {
        $this->addForeignKey('fk_vote_item', 'vote_item', 'vote_id', 'vote', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_vote_item','vote_item');
    }

}