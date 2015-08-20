<?php

class m150419_121245_faq_2all_subportals extends CDbMigration
{
	public function up()
	{
        foreach (NavItems::model()->with('menu')
                     ->findAllByAttributes(array('title' => 'Пресс-центр')) as $parent){

            $url = new UrlManager();
            $url->url = 'faqs/front/index';
            $url->portal_id = $parent->menu->portal_id;

            if (!$url->save()) {
                var_dump($url->errors);
//                return false;
            }

            echo "url saved: {$url->id} \n";

            $child = new NavItems();
            $child->attributes = array(
                'menuId' => $parent->menu->id,
                'title' => 'Часто задаваемые вопросы',
                'url_id' => $url->id,
                'parent_id' => $parent->id,
                'state' =>1,
                'is_link' => true
            );

            $child->save();
        }
	}

	public function down()
	{
		echo "m150419_121245_faq_2all_subportals does not support migration down.\n";
		return true;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}