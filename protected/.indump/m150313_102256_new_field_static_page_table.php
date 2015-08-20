<?php

class m150313_102256_new_field_static_page_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('static_page', 'external_link', 'varchar(500)');
    }

    public function down()
    {
        $this->dropColumn('static_page', 'external_link');
    }
}