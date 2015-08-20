<?php

class m150302_111330_add_table_category_doc extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('category_doc', array(
			'id'				=>	'pk',
			'name'				=>	'varchar(500) NOT NULL',
		));
		$this->insert('category_doc',array('name' => 'Указ Президента РФ'));
		$this->insert('category_doc',array('name' => 'Постановление Правительства РФ'));
		$this->insert('category_doc',array('name' => 'Федеральный закон'));
		$this->insert('category_doc',array('name' => 'Закон Российской Федерации'));
		$this->insert('category_doc',array('name' => 'Распоряжение Правительства РФ'));
		$this->insert('category_doc',array('name' => 'Приказ'));
		$this->insert('category_doc',array('name' => 'Распоряжение'));
		$this->insert('category_doc',array('name' => 'Методические рекомендации'));
		$this->insert('category_doc',array('name' => 'Проект'));
		$this->insert('category_doc',array('name' => 'Устав'));
		$this->insert('category_doc',array('name' => 'Письмо'));
		$this->insert('category_doc',array('name' => 'Постановление Губернатора Томской области'));
		$this->insert('category_doc',array('name' => 'Закон Томской области'));
		$this->insert('category_doc',array('name' => 'Постановление Администрации Томской области'));
	}

	public function down()
	{
		$this->dropTable('category_doc');
		return true;
	}

}