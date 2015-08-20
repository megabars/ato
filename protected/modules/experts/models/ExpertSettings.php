<?php

/**
 * This is the model class for table "expert_settings".
 *
 * The followings are the available columns in table 'expert_settings':
 * @property string $message
 * @property boolean $isActive
 */
class ExpertSettings extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'expert_settings';
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'message' => 'Сообщение для первой страницы регистрации экспертов',
            'isActive' => 'регистрация экспертов активна'
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ExpertSettings the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
