<?php

class m141218_114828_afisha_new_field_organizer extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m141218_114828_afisha_new_field_organizer does not support migration down.\n";
//		return false;
//	}

    public function safeUp()
    {
        $this->addColumn('afisha','organizer','character varying(255)');
    }


    public function safeDown()
    {
        $this->dropColumn('afisha','organizer');
    }
}