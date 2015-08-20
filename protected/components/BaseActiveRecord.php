<?php

abstract class BaseActiveRecord extends CActiveRecord
{
    public static $uploadFileFolder = '/public/uploads/';

    public static $uploadFilePath = '/uploads/';

    const STATUS_DEFAULT = 0;

    const STATUS_REMOVED = 1;

    /**
     * Отключает ограничение на выборку данных, возвращаемое ф-ей self::getPortalCriteria
     * @var bool
     */
    protected $disablePortalCriteria = false;

    public static function getUploadFolder($withPortal = true)
    {
        if ($withPortal) {
            $portal_id = (!empty(Yii::app()->controller) ? Yii::app()->controller->portalId : 1);
            $result = self::$uploadFileFolder . "$portal_id/";
        } else {
            $result = self::$uploadFileFolder;
        }

        return $result;
    }

    public static function getUploadPath($portal_id = null)
    {
        if ($portal_id === null)
            $portal_id = Yii::app()->controller->portalId;

        return self::$uploadFilePath . "$portal_id/";
    }

    public function published()
    {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.state = 1',
        ));

        return $this;
    }

    public function sorted($sort = 'DESC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "t.date {$sort}",
        ));

        return $this;
    }

    public function limit($limit)
    {
        $this->getDbCriteria()->mergeWith(array(
            'limit' => $limit,
        ));

        return $this;
    }


    /**
     * Цепляем выборку на конкретный портал
     * @return array
     */
    public function defaultScope()
    {
        parent::defaultScope();
        if (!(Yii::app() instanceof CConsoleApplication)) {
            $cArr = $this->getPortalCriteria();
            // Выбираем не удаленные
            if ($this->hasAttribute('is_deleted')) {
                $condition = "{$this->getTableAlias(true, false)}.is_deleted=" . self::STATUS_DEFAULT;
                $cArr['condition'] = (isset($cArr['condition'])) ? $cArr['condition'] . " AND " . $condition : $condition;
            }
            return $cArr;
        } else {
            return array();
        }
    }

    /**
     * Используется если надо потянуть данные по всем порталам
     * @return $this
     */
    public function allPortalsCriteria(){
        $this->disablePortalCriteria = true;
        return $this;
    }

    /**
     * НЕ ИСПОЛЬЗУЕТСЯ, ОСТАВИЛ ДЛЯ ПРИМЕРА
     * сделано для субпортала экспетных советов, он всю инфу тянет из дочерних
     * @deprecated
     * @return $this
     */
    public function allExpertsCriteria()
    {
        $portal = Portal::model()->findByPk(Yii::app()->controller->portalId);
        if ($portal->theme == 'expert_main' && Yii::app()->theme->name != 'admin') {
            // берем все дочерние порталы экспертных советов
            $inProtalIds = array($portal->id);

            foreach (Portal::model()->findAllByAttributes(array('theme' => 'expert')) as $p) {
                $inProtalIds[] = $p->id;
            }

            $this->disablePortalCriteria = true;

            $this->getDbCriteria()->mergeWith(new CDbCriteria(array(
                'condition' => "{$this->getTableAlias(true, false)}.portal_id IN (" . implode(',', $inProtalIds) . ")"
            )));
        }

        return $this;
    }

    /**
     * Массив для инициализации CDBCriteria, использующейся выборки данных по конкретному порталу.
     * @see NavItems - пример использования для модели без поля portal_id
     * @return array
     */
    protected function getPortalCriteria()
    {
        $result = array();
        if ($this->hasAttribute('portal_id') && isset(Yii::app()->controller->portalId) && !$this->disablePortalCriteria){
            $result['condition'] = "{$this->getTableAlias(true, false)}.portal_id = :portal_id";
            $result['params'] = array('portal_id' => Yii::app()->controller->portalId);
        }

        return $result;
    }

    /**
     * Выбираем удаленные записи для определенного портала
     * @return $this
     */
    public function removed()
    {
        $cArr = $this->getPortalCriteria();
        if ($this->hasAttribute('is_deleted')) {
            $condition = "{$this->getTableAlias(true, false)}.is_deleted=" . self::STATUS_REMOVED;
            $cArr['condition'] = (isset($cArr['condition'])) ? $cArr['condition'] . " AND " . $condition : $condition;
        }
        $this->resetScope()->getDbCriteria()->mergeWith($cArr);

        return $this;
    }


    /**
     * Всем моделям у которых есть portal_id надо его выставлять...
     * @return bool
     */
    public function beforeValidate()
    {
        if (!parent::beforeValidate())
            return false;

        if ($this->hasAttribute('portal_id') && empty($this->portal_id) && isset(Yii::app()->controller->portalId))
            $this->portal_id = Yii::app()->controller->portalId;

        return parent::beforeValidate();
    }

    /**
     * Если у модели есть аттрибут is_deleted, то запись не удаляем, а ставим статус "Удален"
     */
     public function deleteByPk($pk,$condition='',$params=array())
    {
        if ($this->hasAttribute('is_deleted')) {
            return $this->updateByPk($pk,array('is_deleted'=>self::STATUS_REMOVED),$condition,$params);
        } else {
            return parent::deleteByPk($pk,$condition,$params);
        }
    }

    public function deleteAll($condition='',$params=array())
    {
        if ($this->hasAttribute('is_deleted')) {
            return $this->updateAll(array('is_deleted'=>self::STATUS_REMOVED),$condition,$params);
        } else {
            return parent::deleteAll($condition,$params);
        }
    }

    public function deleteAllByAttributes($attributes,$condition='',$params=array())
    {
        if ($this->hasAttribute('is_deleted')) {
            Yii::trace(get_class($this).'.updateAll()','system.db.ar.CActiveRecord');
            $builder=$this->getCommandBuilder();
            $table=$this->getTableSchema();

            // нижеследующее нужно для установки кастомного префикса параметров. взято из CDbCommandBuilder->createColumnCriteria($table,$attributes,$condition,$params).
            // проблема в createUpdateCommand->createUpdateCommand($table,array('is_deleted'=>self::STATUS_REMOVED),$criteria), где параметры данных для обновления и
            // параметры данных критерия не мержатся, а перезаписывются  в колонке is_deleted устанавливается первый параметр из критерии.
            $prefix = '';
            $customParamPrefix = ':customDeleteAll_';
            $criteria=$builder->createCriteria($condition,$params);
            if($criteria->alias!='')
                $prefix=$builder->_schema->quoteTableName($criteria->alias).'.';
            $bindByPosition=isset($criteria->params[0]);
            $conditions=array();
            $values=array();
            $i=0;
            foreach($attributes as $name=>$value) {
                if(($column=$table->getColumn($name))!==null) {
                    if(is_array($value))
                        $conditions[]=$builder->createInCondition($table,$name,$value,$prefix);
                    elseif($value!==null) {
                        if($bindByPosition){
                            $conditions[]=$prefix.$column->rawName.'=?';
                            $values[]=$value;
                        } else {
                            $conditions[]=$prefix.$column->rawName.'='.$customParamPrefix.$i;
                            $values[$customParamPrefix.$i]=$value;
                            $i++;
                        }
                    } else
                        $conditions[]=$prefix.$column->rawName.' IS NULL';
                } else
                    throw new CDbException(Yii::t('yii','Table "{table}" does not have a column named "{column}".',
                        array('{table}'=>$table->name,'{column}'=>$name)));
            }
            $criteria->params=array_merge($values,$criteria->params);
            if(isset($conditions[0])) {
                if($criteria->condition!='')
                    $criteria->condition=implode(' AND ',$conditions).' AND ('.$criteria->condition.')';
                else
                    $criteria->condition=implode(' AND ',$conditions);
            }

            $command=$builder->createUpdateCommand($table,array('is_deleted'=>self::STATUS_REMOVED),$criteria);
            return $command->execute();

        } else {
            return parent::deleteAllByAttributes($attributes,$condition,$params);
        }
    }

    public function realDelete() {

        if(!$this->getIsNewRecord())
        {
            Yii::trace(get_class($this).'.delete()','system.db.ar.CActiveRecord');
            if($this->beforeDelete())
            {
                $this->beforeRealDelete();

                $result=$this->realDeleteByPk($this->getPrimaryKey())>0;
                $this->afterDelete();
                return $result;
            }
            else
                return false;
        }
        else
            throw new CDbException(Yii::t('yii','The active record cannot be deleted because it is new.'));
    }

    public function beforeRealDelete()
    {

    }

    /**
     * Удаление записи в обход переопределенного метода deleteByPk()
     */
    public function realDeleteByPk($pk,$condition='',$params=array())
    {
        return parent::deleteByPk($pk,$condition,$params);
    }

    public static function getFileUrl($fileId)
    {
        if ($model = File::model()->resetScope()->findByPk($fileId)) {
            $self = get_called_class();

            return $self::getUploadPath($model->portal_id) . $model->name;
        }

        return '/';
    }

    /**
     * Логтрует изменение - добавление записей
     * @return bool
     */
    protected function beforeSave()
    {
        // Чтобы при открытии корзины не записывался в лог (например StaticPage)
        if($this->hasAttribute('is_deleted') && $this->is_deleted==self::STATUS_REMOVED) {
            return TRUE;
        } else {
            parent::beforeSave();

            if (!(Yii::app() instanceof CConsoleApplication)) {
                $model = new Log();

                $model->attributes = array(
                    'changedModel' => get_called_class(),
                    'typeOfChange' => ($this->isNewRecord) ? 'create' : 'update',
                    'userId' => !empty(Yii::app()->user) ? Yii::app()->user->id : 0,
                    'recordId' => $this->getPrimaryKey(),
                );

                if (!empty($this->portal_id))
                    $model->portal_id = $this->portal_id;
    
                $model->save();
            }
        }

        return parent::beforeSave();
    }

    protected function beforeDelete()
    {
        if (!(Yii::app() instanceof CConsoleApplication)) {
            $model = new Log();

            $model->attributes = array(
                'changedModel' => get_called_class(),
                'typeOfChange' => 'delete',
                'userId' => !empty(Yii::app()->user) ? Yii::app()->user->id : 0,
                'portal_id' => !empty($model->portal_id) ? $model->portal_id : 1,
                'recordId' => $this->id,
            );

            $model->save();
        }

        return  parent::beforeDelete();
    }


}
