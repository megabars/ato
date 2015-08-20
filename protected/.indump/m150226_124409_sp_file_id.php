<?php

class m150226_124409_sp_file_id extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150226_124409_sp_file_id does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->addColumn('static_page', 'file_id', 'int default null');
	}
    /*

    public function safeDown()
    {
    }
    */
}