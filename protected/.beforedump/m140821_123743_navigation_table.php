<?php

class m140821_123743_navigation_table extends CDbMigration
{

	public function down()
	{
		echo "m140821_123743_NavItems_table does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        switch ($this->dbType()) {
            case "pgsql":
                $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS nav_items (
                id serial NOT NULL,
                portal_id smallint NOT NULL,
                title varchar(255) NOT NULL,
                url varchar(500) NOT NULL,
                parent_id smallint DEFAULT 0,
                ordi smallint DEFAULT NULL,
                state smallint DEFAULT 0,
                menuId smallint NOT NULL,
                PRIMARY KEY (id))")->execute();

                break;

            default:
            case "mysql":
                $this->dbConnection->createCommand("CREATE TABLE IF NOT EXISTS `nav_items` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `portal_id` int(11) NOT NULL,
                `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `url` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
                `parent_id` int(11) DEFAULT '0',
                `ordi` int(11) DEFAULT NULL,
                `state` int(11) DEFAULT '0',
                `menuId` int(11) NOT NULL,

                PRIMARY KEY (`id`),
                KEY `FK_nav_items_parent` (`portal_id`),
                KEY `FK_nav_items_parents` (`parent_id`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ")->execute();
                break;
        }


        $this->dbConnection->createCommand("INSERT INTO nav_items (portal_id, title, url, parent_id, ordi, state, menuId) VALUES
          (1, 'Статическая страница', 'static', 0, 1, 1,1),
          (1, 'Новости', 'news', 0, 2, 1,1),
          (1, 'Обратная связь', 'feedback', 0, 3, 1,1);")->execute();

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