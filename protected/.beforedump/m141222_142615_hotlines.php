<?php

class m141222_142615_hotlines extends CDbMigration
{
//	public function up()
//	{
//	}
//
//	public function down()
//	{
//		echo "m141222_142615_hotlines does not support migration down.\n";
//		return false;
//	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable('hotlines', array(
			'id'=>'pk',
			'name'=>'varchar(255)',
			'phone'=>'varchar(255)',
		));
		$this->insert('hotlines', array(
			'name' => 'Единая диспетчерская ЖКХ Ростовской области, в том числе по вопросам отопления',
			'phone' => '(863) 240-13-60',
		));
		$this->insert('hotlines', array(
			'name' => 'Центр телефонного обслуживания (единая справочная о предоставлении государственных и муниципальных услуг)',
			'phone' => '8-800-100-70-10',
		));
		$this->insert('hotlines', array(
			'name' => 'Единый телефон лесной охраны',
			'phone' => '8-800-100-94-00',
		));
		$this->insert('hotlines', array(
			'name' => 'Вопросы малого и среднего предпринимательства',
			'phone' => '8-800-555-00-61',
		));
	}

	public function safeDown()
	{
		$this->dropTable("hotlines");
	}

}