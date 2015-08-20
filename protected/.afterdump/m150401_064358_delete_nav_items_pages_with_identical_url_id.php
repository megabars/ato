<?php

class m150401_064358_delete_nav_items_pages_with_identical_url_id extends CDbMigration
{
	public function up()
	{
        $portals = Portal::model()->findAll();
        foreach($portals as $portal) {
            $this->deleteIdenticalUrl($portal->id);
        }
	}

	public function down()
	{
		echo "m150401_064358_delete_nav_items_pages_with_identical_url_id does not support migration down.\n";
		return false;
	}

    protected function deleteIdenticalUrl($portalId) {
//        $c1 = new CDbCriteria();
//        $c1->with = array('url');
//        $c1->addCondition("url.portal_id = '{$portalId}'");
//        $c1->order = "t.url_id ASC, t.id ASC, t.state DESC, t.is_deleted DESC";
//
//        $navItemUrlId = 0;
//        $navItems = NavItems::model()->findAll($c1);
//        foreach($navItems as $navItem) {
//            if($navItem->url_id == $navItemUrlId) {
//                NavItems::model()->realDeleteByPk($navItem->id);
//            } else {
//                $navItemUrlId = $navItem->url_id;
//            }
//        }
//
//
//        $c2 = new CDbCriteria();
//        $c2->addCondition("portal_id = '{$portalId}'");
//        $c2->order = "t.url_id ASC, t.state DESC, t.is_deleted DESC";
//
//        // это работает если закомментировать StaticPage->afterFind();
//        $staticPageUrlId = 0;
//        $staticPages = StaticPage::model()->findAll($c2);
//        foreach($staticPages as $staticPage) {
//            if($staticPage->url_id == $staticPageUrlId) {
//                StaticPage::model()->realDeleteByPk($staticPage->id);
//            } else {
//                if(isset($staticPage->url_id))
//                    $staticPageUrlId = $staticPage->url_id;
//            }
//        }
    }
}