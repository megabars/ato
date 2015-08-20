<?php

class m150414_073008_experts_helper_data extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		ExpertsHelper::model()->deleteAll();
		return true;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        foreach (Portal::model()->findAllByAttributes(array('theme'=>'expert', 'is_deleted' => 0)) as $p) {
            $model = new ExpertsHelper();
            $model->name = $p->title;

            if (!$model->save()) {
                print_r($model->getErrors()); die;
            }

        }

	}

    /*
    public function safeDown()
    {
    }
    */
}