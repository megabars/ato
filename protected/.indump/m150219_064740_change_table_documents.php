<?php

class m150219_064740_change_table_documents extends CDbMigration
{
    public function up()
    {
        $this->addColumn('documents', 'note', 'varchar(500)');
        $this->addColumn('documents', 'public', 'varchar(500)');
        $this->addColumn('documents', 'pdf', 'integer');
        $this->addColumn('documents', 'doc', 'integer');
        $this->addColumn('documents', 'zip', 'integer');
        $this->addColumn('documents', 'change_date', 'integer');
        $this->addColumn('documents', 'description', 'text');
        $this->addColumn('documents', 'executive_id', 'integer');
    }

	public function down()
	{
        $this->dropColumn('documents', 'note');
        $this->dropColumn('documents', 'public');
        $this->dropColumn('documents', 'pdf');
        $this->dropColumn('documents', 'doc');
        $this->dropColumn('documents', 'zip');
        $this->dropColumn('documents', 'change_date');
        $this->dropColumn('documents', 'description');
        $this->dropColumn('documents', 'executive_id');
	}
}