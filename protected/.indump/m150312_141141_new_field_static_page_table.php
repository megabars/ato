<?php

class m150312_141141_new_field_static_page_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('static_page', 'map_id', 'integer');
    }

    public function down()
    {
        $this->dropColumn('static_page', 'map_id');
    }
}