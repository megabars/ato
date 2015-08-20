<?php

class m150302_080021_staticPageNewFields extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150302_080021_staticPageNewFields does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('static_page', 'image_id', 'int default null');
        $this->addColumn('static_page', 'social', 'int default 1');
	}
    /*

    public function safeDown()
    {
    }
    */
}