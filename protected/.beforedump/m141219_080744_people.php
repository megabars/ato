<?php

class m141219_080744_people extends CDbMigration
{
	public function down()
	{
		$this->dropTable('{{people}}');
		echo "m141219_080744_people does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->createTableComment('people', array(
			'id' => 'pk',
			'portal_id'=>"int4 NULL COMMENT 'Портал'",
			'type'=>"int4 NULL COMMENT 'Тип'",
			'photo'=>"int4 NULL COMMENT 'Фото'",
			'full_name'=>"varchar(255) NULL COMMENT 'ФИО'",
			'job'=>"text NULL COMMENT 'Место работы, должность, род занятий'",
			'publish'=>"int4 NULL COMMENT 'Опубликовать'",
			'contact_address'=>"varchar(255) NULL COMMENT 'Адрес'",
			'contact_phone'=>"varchar(255) NULL COMMENT 'Телефон'",
			'contact_fax'=>"varchar(255) NULL COMMENT 'Факс'",
			'contact_site'=>"varchar(255) NULL COMMENT 'Сайт'",
			'contact_email'=>"varchar(255) NULL COMMENT 'E-mail'",
			'main_info'=>"text NULL COMMENT 'Общая информация'",
			'life'=>"text NULL COMMENT 'Биография'",
			'social_vk'=>"varchar(255) NULL COMMENT 'Ссылка vkontakte'",
			'social_tw'=>"varchar(255) NULL COMMENT 'Ссылка twitter'",
			'social_fb'=>"varchar(255) NULL COMMENT 'Ссылка facebook'",
		));

		$this->createTableComment('people_staff', array(
			'id' => 'pk',
			'people_id'=>"int4 NULL COMMENT 'Персоналия'",
			'photo'=>"int4 NULL COMMENT 'Фото'",
			'full_name'=>"varchar(255) NULL COMMENT 'ФИО'",
			'job'=>"text NULL COMMENT 'Место работы, должность, род занятий'",
			'cabinet'=>"varchar(255) NULL COMMENT 'Кабинет'",
			'contact_phone'=>"varchar(255) NULL COMMENT 'Телефон'",
			'contact_fax'=>"varchar(255) NULL COMMENT 'Факс'",
			'contact_email'=>"varchar(255) NULL COMMENT 'E-mail'",
		));

		$this->createTableComment('people_unit', array(
			'id' => 'pk',
			'people_id'=>"int4 NULL COMMENT 'Персоналия'",
			'name'=>"varchar(255) NULL COMMENT 'Название'",
			'url'=>"varchar(255) NULL COMMENT 'Ссылка'",
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