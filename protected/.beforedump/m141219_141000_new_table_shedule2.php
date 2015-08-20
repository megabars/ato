<?php

class m141219_141000_new_table_shedule2 extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m141219_141000_new_table_shedule2 does not support migration down.\n";
//		return false;
//	}

    public function safeUp()
    {
        $this->createTable('reception_schedule', array(
            'id'=>'serial',
            'job_title'=>'varchar(500)',
            'name'=>'varchar(255)',
            'date'=>'integer',
        ));
        $this->insert('reception_schedule', array(
            'job_title' => 'Первый заместитель Губернатора области',
            'name' => 'ГРЕБЕНЩИКОВ Александр Александрович',
            'date' => 1418169600,
        ));
        $this->insert('reception_schedule', array(
            'job_title' => 'Первый заместитель Губернатора области',
            'name' => 'ГУСЬКОВ Игорь Александрович',
            'date' => 1417478400,
        ));
        $this->insert('reception_schedule', array(
            'job_title' => 'аместитель Губернатора области – руководитель аппарата Правительства области',
            'name' => 'АРТЕМОВ Вадим Валентинович',
            'date' => 1419033600,
        ));
    }

    public function safeDown()
    {
        $this->dropTable("reception_schedule");
    }
}