<?php

class m150326_044540_new_field_portal_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('portal', 'code', 'varchar(100)');
    }

    public function down()
    {
        $this->dropColumn('portal', 'code');
    }
}