<?php

class m141215_141954_new_field_id_parent_document_folder extends CDbMigration
{
//	public function up()
//	{
//	}

//	public function down()
//	{
//		echo "m141215_141954_new_field_id_parent_document_folder does not support migration down.\n";
//		return false;
//	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
            $this->addColumn('document_folder','parent_id','integer');
	}


	public function safeDown()
	{
            $this->dropColumn('document_folder','parent_id');
	}

}
