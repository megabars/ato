<?php

class m150410_124959_add_mailing_for_rating extends CDbMigration
{
	public function safeUp()
	{
        // добавляем alias для mailGroup.
        $this->addColumn('mail_group', 'alias', 'string');

        $mailGroup = new MailGroup();
        $mailGroup->name = 'Рассылка на обновления ОРВ';
        $mailGroup->alias = 'orv';
        return $mailGroup->save();

	}

	public function down()
	{
        echo "m150409_130344_add_menu_for_rating does not support migration down.\n";
        return true;
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