<?php

class m140821_114159_portal_table extends CDbMigration
{
//	public function up()
//	{
//	}

    public function down()
    {
        echo "m140821_114159_portal_table does not support migration down.\n";
        return true;
    }

    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
        switch ($this->dbType()) {
            case "pgsql":
                $this->dbConnection->createCommand('CREATE TABLE IF NOT EXISTS portal (
                id serial NOT NULL,
                title varchar(255) NOT NULL,
                alias varchar(255) NOT NULL,
                PRIMARY KEY (id));')->execute();

                break;


            default:
            case "mysql":
                $this->dbConnection->createCommand('CREATE TABLE IF NOT EXISTS `portal` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci')->execute();
                break;
        }

        $this->dbConnection->createCommand("INSERT INTO portal (id, title, alias) VALUES (1, 'Основной', 'new_portal.dev');")->execute();
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