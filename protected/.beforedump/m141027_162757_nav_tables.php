
<?php

/**
 * Created with https://github.com/schmunk42/database-command
 */

class m141027_162757_nav_tables extends CDbMigration 
{
    public function safeUp() 
    {
        $sql = <<< END
CREATE TABLE IF NOT EXISTS nav_menu (
    id SERIAL NOT NULL,
    name varchar(255) NOT NULL,
    PRIMARY KEY (id)     
);

INSERT INTO nav_menu (id, name) VALUES
('1', 'Главное меню'),
('2', 'Меню второго уровня');
 
ALTER TABLE nav_items 
ADD CONSTRAINT fk_nav_items_nav_menu_menuIs FOREIGN KEY (menuId) REFERENCES nav_menu (id) ON DELETE CASCADE ON UPDATE CASCADE;
END;
    $command = $this->dbConnection->createCommand();
    $command->text = $sql;
    $command->execute();
    // Foreign Keys for table 'nav_items'
    //if (($this->dbConnection->schema instanceof CSqliteSchema) == false):
    //    $this->addForeignKey('fk_nav_items_nav_menu_menuId', 'nav_items', 'menuId', 'nav_menu', 'id', 'CASCADE', 'CASCADE'); // FIX RELATIONS 
    //endif;
}

    public function safeDown() 
    {
        echo 'Migration down not supported.';
    }
}
?>

