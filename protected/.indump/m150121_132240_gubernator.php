<?php

class m150121_132240_gubernator extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m150121_132240_gubernator does not support migration down.\n";
//		return false;
//	}

	public function safeUp()
	{
		$this->createTable('gubernator', array(
			'id'=>'pk',
			'title'=>'varchar(255)',
			'state'=>'integer',
			'url'=>'varchar(500)',
		));
		$this->insert('gubernator', array(
			'title' => 'Три кожевниковских кита',
			'state' => 1,
			'url' => 'http://gubernator.tomsk.ru/words/tri-kozhevnikovskih-kita',
		));
		$this->insert('gubernator', array(
			'title' => 'Год культуры. Продолжение следует',
			'state' => 1,
			'url' => 'http://gubernator.tomsk.ru/words/god-kulturyi-prodolzhenie-sleduet',
		));

		$this->createTable('gubernator_info', array(
			'id'=>'pk',
			'fio'=>'varchar(255)',
			'photo'=>'integer',
			'type'=>'varchar(255)',
		));
		$this->insert('gubernator_info', array(
			'fio' => 'Жвачкин Сергей Анатольевич',
			'photo' => 543,
			'type' => 'guber',
		));
	}

	public function safeDown()
	{
		$this->dropTable("gubernator");
	}
}