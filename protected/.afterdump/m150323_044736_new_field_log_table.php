<?php

class m150323_044736_new_field_log_table extends CDbMigration
{
    public function up()
    {
        $this->addColumn('log', 'recordId', 'integer');
    }

    public function down()
    {
        $this->dropColumn('log', 'recordId');
    }
}