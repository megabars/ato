<?php

class m150217_104800_urlManagerTablesChange extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150217_104800_urlManagerTablesChange does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

        $this->addColumn('nav_items', 'url_id', 'integer');
        $this->addColumn('static_page', 'url_id', 'integer');

        foreach (NavMenu::model()->findAll() as $menu) {
            foreach ($menu->navItems as $item) {
                $urlManager = new UrlManager();
                $urlManager->attributes = array(
                    'url' => $item->url,
                    'portal_id' => $menu->portal_id
                );

                if (!$urlManager->save(false)){
                    print_r($urlManager->getErrors()); die;}


                $item->url_id = $urlManager->id;

                if (!$item->save(false)){
                    print_r($item->getErrors()); die;}

                $spage = StaticPage::model()->findByAttributes(array('url' => $urlManager->url));

                if ($spage !== null) {
                    $spage->url_id = $urlManager->id;
                    if (!$spage->save(false)) {
                        print_r($spage->getErrors()); die;}

                }

            }
        }

        $this->dropColumn('nav_items', 'url');
        $this->dropColumn('static_page', 'url');


	}

    /*
    public function safeDown()
    {
    }
    */
}