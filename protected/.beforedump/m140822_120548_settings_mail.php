<?php

class m140822_120548_settings_mail extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m140822_120548_settings_mail does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS settings_mail (
  id SERIAL NOT NULL,
  portal_id NUMERIC(11) NOT NULL,
  server_email varchar(255) DEFAULT NULL,
  type NUMERIC(1) DEFAULT '0',
  smtp_host varchar(255) DEFAULT NULL,
  smtp_port NUMERIC(11) DEFAULT NULL,
  smtp_username varchar(255) DEFAULT NULL,
  smtp_password varchar(255) DEFAULT NULL,
  sendmail_path varchar(255) DEFAULT NULL,
  PRIMARY KEY (id)
)")->execute();
        $this->dbConnection->createCommand("INSERT INTO settings_mail (id, portal_id, server_email, type, smtp_host, smtp_port, smtp_username, smtp_password, sendmail_path) VALUES
(1, 1, 'chirkovalexandr@mail.ru', 0, 'smtp.gmail.com', 465, 'eduportal64@gmail.com', 'portaledu641', '');")->execute();
	}

    /*
	public function safeDown()
	{
	}
	*/
}
