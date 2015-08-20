<?php

class m150414_074501_staff_state_table extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable("staff_state", array(
            "id" => "pk",
            "title" => "varchar(255) NOT NULL",
        ));

        $this->insert('staff_state', array('id' => 1, 'title' => 'прием документов'));
        $this->insert('staff_state', array('id' => 2, 'title' => 'конкурсные процедуры завершены'));
	}

	public function down()
	{
		echo "m150414_074501_staff_state_table does not support migration down.\n";
		return false;
	}
}