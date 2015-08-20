<?php

class m150331_130042_change_table_appeal_schedule extends CDbMigration
{
	public function up()
	{
        // удаляем имеющиеся записи
//        $records = AppealSchedule::model()->findAll();
//        foreach($records as $record) {
//            $record->realDeleteByPk($record->id);
//        }

        $this->dropColumn('appeal_schedule', 'job_title');
        $this->dropColumn('appeal_schedule', 'name');
        $this->dropColumn('appeal_schedule', 'date');

        $this->addColumn('appeal_schedule', 'date', 'integer');
        $this->addColumn('appeal_schedule', 'people_id', 'integer');
        $this->addColumn('appeal_schedule', 'week_days', 'varchar(255)');
        $this->addColumn('appeal_schedule', 'time_start', 'integer');
        $this->addColumn('appeal_schedule', 'time_end', 'integer');
	}

	public function down()
	{
        $this->dropColumn('appeal_schedule', 'people_id');
        $this->dropColumn('appeal_schedule', 'week_days');
        $this->dropColumn('appeal_schedule', 'time_start');
        $this->dropColumn('appeal_schedule', 'time_end');

        $this->addColumn('appeal_schedule', 'job_title', 'varchar(500)');
        $this->addColumn('appeal_schedule', 'name', 'varchar(255)');
    }
}