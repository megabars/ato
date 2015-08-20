<?php

class m140821_124505_static_pages_table extends CDbMigration
{
//	public function up()
//	{
//	}

    public function down()
    {
        echo "m140821_124505_static_pages_table does not support migration down.\n";
        return false;
    }

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {

        switch ($this->dbType()) {
            case "pgsql":
                $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS page (
                  id serial NOT NULL,
                  portal_id integer NOT NULL,
                  parent_id integer NOT NULL,
                  title varchar(255) NOT NULL,
                  url varchar(500) NOT NULL,
                  content text,
                  state NUMERIC(11) DEFAULT '0',
                  PRIMARY KEY (id));")->execute();
                break;


            default:
            case "mysql":
            $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS `page` (
                  `id` int(11) NOT NULL AUTO_INCREMENT,
                  `portal_id` int(11) NOT NULL,
                  `parent_id` int(11) NOT NULL,
                  `title` varchar(255) NOT NULL,
                  `url` varchar(500) NOT NULL,
                  `content` longtext,
                  `state` int(11) DEFAULT '0',
                  PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8")->execute();
                break;


        }

        $this->dbConnection->createCommand("INSERT INTO page (portal_id, parent_id, title, url, content, state) VALUES
        (1, 0, 'static page title', 'static', '<p>Обычная статическая страница</p>\r\n', 1)")->execute();
    }

    public function dbType()
    {
        list($type) = explode(':', Yii::app()->db->connectionString);
        echo "type db: " . $type . "\n";
        return $type;
    }
    /*
    public function safeDown()
    {
    }
    */
}
