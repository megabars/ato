<?php

class m150222_180717_foldersGroup extends CDbMigration
{


	public function down()
	{
		echo "m150222_180717_foldersGroup does not support migration down.\n";
		return false;
	}

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{

        $this->dropColumn('document_folder', 'portal_id');
        $this->addColumn('folders_group', 'portal_id', 'integer default 1');

        $group = new FoldersGroup();
        $group->attributes = array(
            'portal_id' => 1,
            'alias' => 'main'
        );

        if (!$group->save()){
            print_r($group->getErrors());
            die;
        }

        foreach (DocumentsFolder::model()->findAll() as $folder) {
            if ($folder->group_id == '') {
                $folder->group_id = $group->id;
                $folder->save();
            }
        }





	}

    /*

    public function safeDown()
    {
    }
    */
}