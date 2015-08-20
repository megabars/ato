<?php

/**
 * @property BaseActiveRecord $owner
 * Class OrderBehavior
 */
class OrderBehavior extends CActiveRecordBehavior
{
    public function beforeSave($event)
    {
        if ($this->owner->isNewRecord && !is_numeric($this->owner->ordi))
        {
            $criteria = new CDbCriteria();
            $criteria->order = 'ordi DESC';
            $criteria->limit = 1;

            $record = $this->owner->resetScope()->find($criteria);

            if ($record)
                $this->owner->ordi = $record->ordi + 1;
            else
                $this->owner->ordi = 1;
        }
    }

    public function afterDelete($event)
    {
        $criteria = new CDbCriteria();
        $criteria->addCondition("ordi > {$this->owner->ordi}");

        // Уменьшаем ordi у всех записей, следующих после удаляемой
        foreach ($this->owner->findAll($criteria) as $record)
        {
            $record->ordi = $record->ordi - 1;
            $record->save();
        }

        return true;
    }
}