<?php

/**
 * Class Groups
 */
class GroupsForm extends CFormModel
{
    public $id;
    public $name;

    public function rules()
    {
        return array(
            array('name', 'required'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'id'      => 'ID',
            'name'    => 'Название группы',
        );
    }
}
