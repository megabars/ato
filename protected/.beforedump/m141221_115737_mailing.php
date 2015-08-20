<?php

class m141221_115737_mailing extends CDbMigration
{
	public function down()
	{
		echo "m141221_115737_mailing does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		$this->createTableComment('mail_group', array(
			'id' => 'pk',
			'name'=>"varchar(255) NULL COMMENT 'Название'",
		));

		$this->createTableComment('mail_email_list', array(
			'id' => 'pk',
			'email'=>"varchar(255) NULL COMMENT 'E-mail'",
			'first_name'=>"varchar(255) NULL COMMENT 'Имя'",
			'last_name'=>"varchar(255) NULL COMMENT 'Фамилия'",
			'surname'=>"varchar(255) NULL COMMENT 'Отчество'",
			'agreement'=>"int2 NULL DEFAULT 0 COMMENT 'Согласие'",
		));

		$this->createTableComment('mail_group_email_list', array(
			'id' => 'pk',
			'list_id'=>"int4 NULL COMMENT 'E-mail'",
			'group_id'=>"int4 NULL COMMENT 'Группа'",
		));

		$this->createTableComment('mail_template', array(
			'id' => 'pk',
			'name'=>"varchar(255) NULL COMMENT 'Название'",
			'content'=>"text NULL COMMENT 'Контент'",
		));

		$this->createTableComment('mail_subscribe', array(
			'id' => 'pk',
			'name'=>"varchar(255) NULL COMMENT 'Название рассылки'",
			'group_id'=>"int4 NULL COMMENT 'Группа'",
			'template_id'=>"int4 NULL COMMENT 'Шаблон'",
			'sender_email'=>"varchar(255) NULL COMMENT 'Адреса отправителя'",
			'date'=>"int4 NULL DEFAULT 0 COMMENT 'Дата'",
			'is_send'=>"int2 NULL DEFAULT 0 COMMENT 'Отправлено'",
		));

		$this->createTableComment('mail_subscribe_files', array(
			'id' => 'pk',
			'subscribe_id'=>"int4 NULL COMMENT 'Рассылка'",
			'photo'=>"int4 NULL DEFAULT 0 COMMENT 'Файл'",
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