<?php

class m150419_120650_faq_portal_id extends CDbMigration
{
	public function up()
	{
        $this->addColumn('faqs', 'portal_id', 'integer default null');

        foreach (Faqs::model()->findAll() as $faq) {
            $faq->portal_id = 1;
            $faq->save();
        }

	}

	public function down()
	{
		echo "m150419_120650_faq_portal_id does not support migration down.\n";
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