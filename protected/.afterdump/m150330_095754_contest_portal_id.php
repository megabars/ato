<?php

class m150330_095754_contest_portal_id extends CDbMigration
{
	public function up()
	{
        $this->addColumn('contest', 'portal_id', 'integer default null');

        foreach (Contest::model()->findAll() as $contest) {
            $contest->portal_id = 1;
            if (!$contest->save()){
                print_r($contest->getErrors());
                die;
            }

        }
	}

	public function down()
	{
        $this->dropColumn('contest', 'portal_id');
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