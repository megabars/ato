<?php

class m150310_111115_is_deleted_field_for_all_tables extends CDbMigration
{
    public function up()
    {
        $modules = Log::getModules();

        if(isset($modules)) {
            foreach($modules as $module) {
                foreach($module['models'] as $modelName) {
                    $model = new $modelName;
                    if(!$model->hasAttribute('is_deleted'))
                        $this->addColumn($model->tableName(), 'is_deleted', 'integer NOT NULL DEFAULT 0');
                }
            }
        }
    }

    public function down()
    {
        $modules = Log::getModules();

        if(isset($modules)) {
            foreach($modules as $module) {
                foreach($module['models'] as $modelName) {
                    $model = new $modelName;
                    if($model->hasAttribute('is_deleted'))
                        $this->dropColumn($model->tableName(), 'is_deleted');
                }
            }
        }
    }
}