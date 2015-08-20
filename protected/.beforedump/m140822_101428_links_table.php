<?php

class m140822_101428_links_table extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m140822_101428_links_table does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->getDbConnection()->createCommand("CREATE TABLE IF NOT EXISTS links (
  id SERIAL NOT NULL,
  title varchar(255) NOT NULL,
  url varchar(500) NOT NULL,
  photo NUMERIC(11) NOT NULL,
  ordi NUMERIC(11) DEFAULT NULL,
  PRIMARY KEY (id)
)")->execute();
        $this->getDbConnection()->createCommand("INSERT INTO links (id, title, url, photo, ordi) VALUES
(1, 'Портал1', 'http://google.ru', 618, 2),
(2, 'Портал2', 'http://yandex.ru', 620, 1),
(3, '4', '543', 628, 3);")->execute();
	}
    /*
	public function safeDown()
	{
	}
	*/
}
