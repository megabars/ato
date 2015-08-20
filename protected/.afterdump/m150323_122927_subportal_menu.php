<?php

class m150323_122927_subportal_menu extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150323_122927_subportal_menu does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        foreach (Portal::model()->findAll('id != 1') as $portal) {
            $menu = new NavMenu();
            $menu->portal_id = $portal->id;
            $menu->name = 'Боковое меню главной страницы';
            $menu->alias = 'right_menu';

            if (!$menu->save()) {
                print_r($menu);
                die;
            }

            $items = array(
                'tariff-map' => 'Карта тарифов',
                "eias" => 'ЕИАС',
                "show-information" => 'Раскрытие информации',
                "communal-serv" => 'Коммунальные услуги',
                "energy-saving" => 'Энергосбережение'
            );

            foreach ($items as $url => $name) {

                $urlModel = new UrlManager();
                $urlModel->portal_id = $portal->id;
                $urlModel->url = $url;

                if (!$urlModel->save()) {
                    print_r($urlModel->getErrors());
                    die;
                }

                $nav = new NavItems();
                $nav->attributes = array(
                    'title' => $name,
                    'url_id' => $urlModel->id,
                    'state' => 1,
                    'menuId' => $menu->id,
                    'parent_id' => 0,
                    'is_link' => 1
                );

                if (!$nav->save()) {
                    print_r($name->getErrors());
                    die;
                }

                $page = new StaticPage();
                $page->attributes = array(
                    'portal_id' => $portal->id,
                    'title' => $name,
                    'url_id' => $urlModel->id,
                    'state' => 1,
                    'date' => date('Y-m-d H:m:s')
                );

                if (!$page->save()){
                    print_r($page->getErrors());
                    die;
                }
            }


        }
	}
    /*
    public function safeDown()
    {
    }
    */
}