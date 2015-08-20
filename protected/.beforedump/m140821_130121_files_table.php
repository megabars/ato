<?php

class m140821_130121_files_table extends CDbMigration
{

	public function down()
	{
		echo "m140821_130121_files_table does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS file (
  id SERIAL NOT NULL,
  portal_id NUMERIC(11) NOT NULL,
  origin_name varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  size NUMERIC(11) NOT NULL,
  ext varchar(10) NOT NULL,
  date NUMERIC(11) NOT NULL,
  PRIMARY KEY (id)
)")->execute();

	}

    /*
	public function safeDown()
	{
	}
	*/
}
