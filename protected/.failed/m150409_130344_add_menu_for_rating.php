<?php

class m150409_130344_add_menu_for_rating extends CDbMigration
{

	public function down()
	{
		echo "m150409_130344_add_menu_for_rating does not support migration down.\n";
		return true;
	}

	public function safeUp()
	{
        $list = self::getLinkList();
        $c = 0;
        $portals = Portal::model()->findAll('theme=\'iogv\' OR theme=\'tomsk\'');
        foreach ($portals as $portal) {
            $portal_id = $portal->id;
            $menu_id = NavMenu::model()->find('alias=\'main_menu\' and portal_id='.$portal_id)->id;
            echo "\nPortal: {$portal_id}; MenuId: {$menu_id};\n";

            $nav_id = NavItems::model()->find('"menuId"='. $menu_id .' and title LIKE \'%Оценка регулирующего воздействия%\'')->id;

            foreach ($list as $name => $link) {
                $navItem = new NavItems();
                if (!empty($link)) {
                    $url = new UrlManager();
                    $url->url = $link;
                    $url->portal_id = $portal_id;
                    if (!$url->save()) {
                        var_dump($url->errors);
                        return false;
                    }
                    echo "url saved: {$url->id} \n";
                    $navItem->url_id = $url->id;
                }
                $navItem->menuId = $menu_id;
                $navItem->title = $name;
                $navItem->parent_id = $nav_id;
                $navItem->is_link = 1;
                $navItem->state = 1;

                if (!$navItem->save()) {
                    echo "nav item error: {$name}";
                    var_dump($navItem->errors);
                    echo "\n";
                    return false;
                }
            }
            $c++;
        }
        echo "All done. {$c} portals saved\n";
        return true;
    }

    public static function getLinkList(){
        return array(
            'Информационные материалы'                                              => 'rating/front/index/type/1',
            'Публичные консультации'                                                => 'rating/front/index/type/5',
            'Заключения об ОРВ'                                                     => 'rating/front/index/type/2',
            'Мониторинг фактического воздействия НПА'                               => 'rating/front/index/type/3',
            'План эспертизы'                                                        => 'rating/front/index/type/4',
            'Экспертиза НПА'                                                        => 'rating/front/index/type/6',
            'ОРВ в муниципальных образованиях'                                      => 'Orv-v-municipalnyh-obrazovaniyah',
            'Подписка на рассылку'                                                  => 'rating/front/feedback',
            'Нормативно-правовая база муниципальных образований Томской области'    => 'normativno-pravovaya-baza-municipalnyh-obrazovaniy-tomskoy-oblasty',
            'Соглашения о взаимодействии с муниципальными образованиями Томской области' => 'soglasheniya-o-vzaimodeystvii-s-municipalnymi-obrazovaniyami-tomskoy-oblasty',
            'Практики проведения ОРВ в муниципальных образованиях Томской области' => 'praktiki-provedeniya-orv-v-municipalnyh-obrazovaniyah-tomskoy-oblasty',


        );
    }
    /*
	public function safeDown()
	{
	}
	*/
}