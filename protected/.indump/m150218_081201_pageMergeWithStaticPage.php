<?php

class m150218_081201_pageMergeWithStaticPage extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150218_081201_pageMergeWithStaticPage does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dropColumn('static_page', 'seo_id');
        $this->addColumn('static_page', 'type_id', 'int default 0');

        $this->dropTable('page');


	}
    /*

    public function safeDown()
    {
    }
    */
}