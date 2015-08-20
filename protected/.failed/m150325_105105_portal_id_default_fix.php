<?php

class m150325_105105_portal_id_default_fix extends CDbMigration
{
    public function up()
    {
        $modules = Log::getModules();

        if(isset($modules)) {
            foreach($modules as $module) {
                foreach($module['models'] as $modelName) {
                    $model = new $modelName;
                    if($model->hasAttribute('portal_id')) {
                        $this->dbConnection->createCommand("ALTER TABLE ".$model->tableName()." ALTER COLUMN portal_id SET DEFAULT NULL;")->execute();
                    }

                }
            }
        }
    }


}