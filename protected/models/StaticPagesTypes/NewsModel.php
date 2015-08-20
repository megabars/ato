<?php

class NewsModel extends StaticPage
{
    public $type_id = RecordType::NEWS;

    public function beforeFind()
    {
        parent::beforeFind();

        $this->getDbCriteria()->mergeWith(array(
            'condition'  => 't.type_id ='. $this->type_id
        ));
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}