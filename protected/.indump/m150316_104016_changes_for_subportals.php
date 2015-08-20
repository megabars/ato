<?php

class m150316_104016_changes_for_subportals extends CDbMigration
{
	public function up()
	{
        // счетчики
        $this->addColumn('counters', 'portal_id', 'integer default 1');

        // обратная связь
        $this->addColumn('feedback', 'portal_id', 'integer default 1');

        // журнал изменений
        $this->addColumn('log', 'portal_id', 'integer default 1');
    }

	public function down()
	{
        // счетчики
        $this->dropColumn('counters', 'portal_id');

        // обратная связь
        $this->dropColumn('feedback', 'portal_id');

        // журнал изменений
        $this->dropColumn('log', 'portal_id');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
?>