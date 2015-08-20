<?php
/**
 * author: Mikhail Matveev
 * Date: 01.12.14 
 */

class Event extends StaticPage {

    public $type_id = RecordType::EVENT;

    public function beforeFind(){
        parent::beforeFind();

        $this->getDbCriteria()->mergeWith(array(
            'condition'  => 't.type_id ='. $this->type_id
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Event the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

}