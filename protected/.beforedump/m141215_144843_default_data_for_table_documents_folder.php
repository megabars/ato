<?php

class m141215_144843_default_data_for_table_documents_folder extends CDbMigration
{
//	public function up()
//	{
//	}
//
	public function down()
	{
		echo "m141215_144843_default_data_for_table_documents_folder does not support migration down.\n";
		return false;
	}


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->update('document_folder', array(
            'title' => 'Принятые правовые акты'),
            'id=1'
        );

        $this->insert('document_folder', array(
            'portal_id' => '1',
            'title' => 'Текущие планы-графики нормативно-правовой работы ИОГВ',
            'description' => 'Описание',
            'state' => 1,
        ));
        $this->insert('document_folder', array(
            'portal_id' => '1',
            'title' => 'Административные регламенты, стандарты государственных услуг',
            'description' => 'Описание',
            'state' => 1,
        ));
        $this->insert('document_folder', array(
            'portal_id' => '1',
            'title' => 'Установленные формы обращений, заявлений и иных документов, принимаемых ИОГВ, его территориальными органами к рассмотрению в соответствии с законами и иными нормативными правовыми актами',
            'description' => 'Описание',
            'state' => 1,
        ));
        $this->insert('document_folder', array(
            'portal_id' => '1',
            'title' => 'Порядок обжалования нормативных правовых актов и иных решений, принятых ИОГВ',
            'description' => 'Описание',
            'state' => 1,
        ));

	}
    /*
     public function safeDown()
        {
        }
        */
}