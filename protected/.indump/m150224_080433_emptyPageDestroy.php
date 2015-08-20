<?php

class m150224_080433_emptyPageDestroy extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150224_080433_emptyPageDestroy does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        foreach (NavMenu::model()->findAll() as $menu) {
            foreach ($menu->navItems as $item) {

                $urlModel = $item->url;

                if ($urlModel === null) {
                    print_r($$item);
                    die;
                }


                if ($urlModel->url == 'empty_page') {

                    $url = Transliterate::text($item->title);
                    $url = preg_replace('/\W/s', '-', $url);

                    $urlModel->url = $url;

                    if (!$urlModel->save()) {
                        print_r($urlModel->getErrors()); die;
                    }


                    $pageModel = new StaticPage();
                    $pageModel->attributes = array(
                        'portal_id' => $menu->portal_id,
                        'title' => $item->title,
                        'url_id' => $urlModel->id,
                        'state' => 1,
                        'description' => 'auto - generated description',
                        'preview' => 'auto - generated preview'
                    );

                    if (!$pageModel->save()){
                        print_r($pageModel->getErrors());die;
                    }
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