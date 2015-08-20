<?php

class m150413_112101_delete_committe_tables extends CDbMigration
{
	public function down()
	{
		echo "m150413_112101_delete_committe_tables does not support migration down.\n";
		return false;
	}

	public function safeUp()
	{
		foreach(array('committee_staff','committee_department','committee') as $tableName)
			if (Yii::app()->db->schema->getTable($tableName,true)!==null)
				$this->dropTable($tableName);
	}
}