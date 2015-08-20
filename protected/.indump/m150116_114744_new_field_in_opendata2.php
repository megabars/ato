<?php

class m150116_114744_new_field_in_opendata2 extends CDbMigration
{
    public function up()
    {
        $this->addColumn('opendata', 'structure_file', 'int');
    }

    public function down()
    {
        echo "m150116_114744_new_field_in_opendata2 does not support migration down.\n";
        return false;
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}