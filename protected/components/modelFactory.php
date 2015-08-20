<?php
/**
 * Description of modelFactory
 *
 * @author mihail
 */
class modelFactory extends CActiveRecord {
   
    /**
     * Возвращает нужную модель по 2 аттрибуту или новый экземпляр
     * @param string $name
     * @param array $params
     * @return CActiveRecord
     */
    public static function get($name, $params, $scenario = '') {
        // если такой экземпляр модели уже есть, то надо обновлять
        // значения в бд, а не создавать новые
        $model = $name::model()->findByAttributes($params);

        if ($model === null) {
            $model = new $name($scenario);
            
            $model->attributes = $params;
        }

        return $model;
    }

    public function save($runValidation=true,$attributes=null)
    {
        if (!parent::save($runValidation,$attributes)){
            Yii::log('Unable to save model! Table name: '.$this->tableName().' model errors: '.print_r($this->getErrors(),1), CLogger::LEVEL_ERROR);
            return false;

        } else {
            return true;
        }
    }

}

?>
