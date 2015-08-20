<?php

class m141222_110933_experts_database extends CDbMigration
{
	public function down()
	{
		echo "m141222_110933_experts_database does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->createTableComment('experts', array(
			'id' => 'pk',
			'portal_id'=>"int4 NULL COMMENT 'Портал'",
			'type'=>"int4 NULL COMMENT 'Тип'",
			'fio'=>"varchar(255) NULL COMMENT 'ФИО'",
			'phone'=>"varchar(255) NULL COMMENT 'Контактный телефон'",
			'email'=>"varchar(255) NULL COMMENT 'Адрес электронной почты'",
			'contact_address'=>"varchar(255) NULL COMMENT 'Место проживания, контактная информация'",
			'skills'=>"varchar(255) NULL COMMENT 'Сферы профессиональных интересов'",
			'education'=>"varchar(255) NULL COMMENT 'Образование'",
			'scientific'=>"varchar(255) NULL COMMENT 'Образование'",
			'education'=>"varchar(255) NULL COMMENT 'Наличие ученой степени'",
			'profession_skill'=>"text NULL COMMENT 'Ключевые профессиональные компетенции'",
			'history'=>"text NULL COMMENT 'Историю участия в экспертных проектах'",
		));

		$this->createTableComment('experts_resources', array(
			'id' => 'pk',
			'experts_id'=>"int4 NULL COMMENT 'Expert'",
			'type'=>"int2 NULL COMMENT 'Тип'",
			'url'=>"varchar(255) NULL COMMENT 'URL'",
		));

	}

	public function createTableComment($table,$columns)
	{
		$create = array();
		$comment = array();
		foreach($columns as $k=>$v)
			if($v!='pk'){
				$colum = explode("COMMENT",$v);
				$create[$k]=$colum[0];
				if(!empty($colum[1]))
					$comment[$k]=@$colum[1];
			}else
				$create[$k]=$v;

		$this->createTable($table, $create);

		foreach($comment as $kc=>$vc)
			Yii::app()->db->createCommand("COMMENT ON COLUMN $table.$kc IS $vc")->query();
	}
}