<?php
/**
 * author: Mikhail Matveev
 * Date: 14.01.15 
 */

class VerbReport extends StaticPage {

    public $type_id = RecordType::VERB_REPORT;


    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return VerbReport the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'type' => 'Тип',
            'title' => 'Заголовок',
            'preview' => 'Анонс',
            'description' => 'Описание',
            'file_id' => 'Прикрепленный файл',
            'date' => 'Дата',
            'state' => 'Опубликовано',
        );
    }

    public function behaviors(){
        return array('DateFieldBehavior');
    }

}