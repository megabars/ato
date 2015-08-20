<?php

class m140821_124950_news_table extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m140821_124950_news_table does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS news (
  id SERIAL NOT NULL,
  portal_id NUMERIC(11) NOT NULL,
  author varchar(255) DEFAULT NULL,
  date NUMERIC(10) DEFAULT NULL,
  photo varchar(255) DEFAULT NULL,
  title varchar(255) NOT NULL,
  preview text,
  description text,
  state NUMERIC(11) DEFAULT '0',
  PRIMARY KEY (id))")->execute();


        $this->dbConnection->createCommand('INSERT INTO news
            (portal_id, date, title, preview, description, state) VALUES
            (1, 1398419100, \'title новости\',
            \'В иституте им. Л.и М. Ростроповичей состоялась встреча ректората и студентов вуза с дочерью маэстро Ольгой.\',
            \'<p>Открывая мероприятие, проректор по научной работе и международным связям Валентина Логинова рассказала о работе творческого вуза и поделилась воспоминаниями о встречах с Мстиславом Ростроповичем в стенах института.</p>\r\n\', 1);')
        ->execute();
	}
    /*
    public function safeDown()
    {
    }
    */
}
