<?php

class m150222_151835_currentLinksMigrate extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150222_151835_currentLinksMigrate does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $group = new LinksGroup();
        $group->attributes = array(
            'portal_id' => 1,
            'alias' => 'main'
        );

        if (!$group->save()){
            print_r($group->getErrors());
            die;
        }

        foreach (Links::model()->findAll() as $link) {
            $link->detachBehavior('ImageBehavior');
                $link->group_id = $group->id;
                $link->save();
        }


	}
    /*
    public function safeDown()
    {
    }
    */
}