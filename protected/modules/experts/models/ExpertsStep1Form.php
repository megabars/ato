<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep1Form
 */
class ExpertsStep1Form extends CFormModel
{
    public $portal_id; //r
    public $subportal_list;

    public function __construct()
    {
        $this->subportal_list = CHtml::listData(ExpertsHelper::model()->published()->findAll(),'id','name');
        parent::__construct();
    }

    public function rules()
    {
        return array(
            array('portal_id', 'required', 'message'=>'Необходимо выбрать Экспертный совет'),
            array('portal_id', 'numerical', 'integerOnly'=>true),
            array('portal_id','safe')
        );
    }

    public function attributeLabels()
    {
        return array(
            'portal_id' => 'Экспертный совет',
        );
    }
}
