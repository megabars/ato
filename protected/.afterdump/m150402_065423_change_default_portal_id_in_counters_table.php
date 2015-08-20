<?php

class m150402_065423_change_default_portal_id_in_counters_table extends CDbMigration
{
//	public function up()
//	{
//	}

//	public function down()
//	{
//		echo "m150402_065423_change_default_portal_id_in_counters_table does not support migration down.\n";
//		return false;
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("ALTER TABLE ONLY counters ALTER COLUMN portal_id DROP DEFAULT;");
    }

	public function safeDown()
	{
        $this->execute("ALTER TABLE ONLY counters ALTER COLUMN portal_id SET DEFAULT 1;");
	}
}