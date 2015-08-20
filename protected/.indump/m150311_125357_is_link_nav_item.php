<?php

class m150311_125357_is_link_nav_item extends CDbMigration
{
	public function up()
	{
//        $this->addColumn('nav_items', 'is_link', 'integer default 1');

        foreach (NavItems::model()->findAll('parent_id = 0') as $item) {
            $item->is_link = 0;
            $item->save();
        }

	}

	public function down()
	{
		echo "m150311_125357_is_link_nav_item does not support migration down.\n";
		return false;
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