<?php

class m150226_140200_new_field_staticPage_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('static_page', 'news_category_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('static_page', 'news_category_id');
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