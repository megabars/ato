<?php

class m150409_082723_regulations_link extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150409_082723_regulations_link does not support migration down.\n";
		return true;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $data = UrlManager::model()->findAllByAttributes(array('url' => '/documents/front/regulations'));
        echo "Found ".count($data)." links on all portals\n";

        $saved = 0;

        foreach ($data as $i) {
            $i->url = '/regulations/front';

            if ($i->save(false)) {
                $saved++;
            } else {
                print_r($i->getErrors());
            }
        }

        echo "All done, saved {$saved} items\n";

        //
	}
    /*
	public function safeDown()
	{
	}
	*/
}