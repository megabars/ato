<?php

class m141107_081127_news_type extends CDbMigration
{

	public function down()
	{
		echo "m141107_081127_news_type does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{

		$this->createTable('{{news_type}}', array(
			'id' => 'SERIAL NOT NULL',
			'alias'=>"varchar(100) NULL",
			'title'=>"text NULL",
		));

		$this->addColumn('{{news}}','type','NUMERIC(11) DEFAULT 0');
	}

}
