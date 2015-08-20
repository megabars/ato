<?php
/**
 * Если в модели есть поле date, то эта штука очень полезна
 * В это поле в БД будет всегда попадать timestamp()
 */

class DateFieldBehavior extends CActiveRecordBehavior
{

    /**
     * @var string в каком формате выводить юзеру данные
     */
    public $dateFormat = 'Y-m-d H:i';

    /**
     * @var array к каким полям прицепить поведение
     */
    public $fields = array('date');

    /**
     * @var string какую дату выставить. Если null - берет timestamp
     */
    public $defaultDate = null;

    public function afterFind($e)
    {
        foreach ($this->fields as $field) {
            if (is_numeric($this->owner->$field)) {
                $this->owner->$field = date($this->dateFormat, $this->owner->$field);
            }
        }
    }

    public function afterConstruct($e)
    {
        foreach ($this->fields as $field) {
            if ($this->owner->$field === null && $this->owner->getScenario() != 'search') {
                if ($this->defaultDate === null)
                    $this->owner->$field = date($this->dateFormat);
                else
                    $this->owner->$field = date($this->dateFormat, $this->defaultDate);
            }
        }
    }


    public function beforeSave($e)
    {
        foreach ($this->fields as $field) {
            if ($this->owner->isNewRecord && !$this->owner->$field) {
                $this->owner->$field = time();
            }
        }
    }

    public function afterSave($e){

        foreach ($this->fields as $field) {
            if (is_numeric($this->owner->$field)) {
                $this->owner->$field = date($this->dateFormat, $this->owner->$field);
            }
        }

    }

    public function beforeValidate($e)
    {
        foreach ($this->fields as $field) {
            if (strtotime($this->owner->$field) !== false && !is_numeric($this->owner->$field)) {
                $this->owner->$field = strtotime($this->owner->$field);
            }
        }
    }



}