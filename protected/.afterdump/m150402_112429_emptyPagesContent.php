<?php

class m150402_112429_emptyPagesContent extends CDbMigration
{
//	public function up()
//	{
//	}

	public function down()
	{
		echo "m150402_112429_emptyPagesContent does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $counter = 0;

        foreach (StaticPage::model()->findAll() as $p) {
            if ($p->description == 'auto - generated description' || $p->description == '') {

//                $p->setScenatio('console');
                $p->detachBehavior('DateFieldBehavior');
                $p->detachBehavior('ImageBehavior');

                $p->description = 'Информация готовится к размещению.';
                if (!$p->save()){
                    print_r($p->getErrors());
                    die;
                } else {
                    $counter++;
                }
            }
        }

        echo "All done, total items saved is {$counter}\n";
	}

    /*
    public function safeDown()
    {
    }
    */
}