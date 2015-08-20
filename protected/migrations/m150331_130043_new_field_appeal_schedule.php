<?php

class m150331_130043_new_field_appeal_schedule extends CDbMigration
{
    public function up()
    {
//        $this->addColumn('appeal_schedule', 'portal_id', 'integer');
        $records = AppealSchedule::model()->findAll();
        foreach($records as $record) {
            $record->portal_id = 1;
            $record->save();
        }
    }

    public function down()
    {
        $this->dropColumn('appeal_schedule', 'portal_id');
    }
}