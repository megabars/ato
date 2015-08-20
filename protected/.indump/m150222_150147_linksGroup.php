<?php

class m150222_150147_linksGroup extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150222_150147_linksGroup does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('links_group', array(
            'id'				=>	'pk',
            'portal_id'         =>  'integer not null default 1',
            'alias'             =>  'VARCHAR(255) default NULL',
        ));

        $this->renameColumn('links', 'page_id', 'group_id');
	}

    /*
    public function safeDown()
    {
    }
    */
}