<?php

/**
 * This is the model class for table "vote".
 *
 * The followings are the available columns in table 'vote':
 * @property integer $id
 * @property integer $portal_id
 * @property string $title
 * @property string $description
 * @property integer $finish
 * @property integer $state
 * @property integer $closed
 * @property integer $date_publish
 *
 * The followings are the available model relations:
 * @property VoteItem[] $voteItems
 */
class Vote extends BaseActiveRecord
{
    public $voteItems = array();

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'vote';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, title', 'required'),
            array('portal_id', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('description', 'safe'),
            array('voteItems', 'itemsValidator'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, title, state, description, finish, closed, date_publish', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'items' => array(self::HAS_MANY, 'VoteItem', 'vote_id'),
            'answersCount' => array(self::STAT, 'VoteUser', 'vote_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'portal_id' => 'Портал',
            'title' => 'Название',
            'description' => 'Описание',
            'state' => 'Опубликовано',
            'finish' => 'Дата завершения',
            'closed' => 'Закрытый',
            'date_publish' => 'Дата публикации результатов',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('finish', $this->finish);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vote the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function itemsValidator($attribute, $params)
    {
        $error = true;

        if (!empty($this->voteItems))
        {
            foreach ($this->voteItems as $items)
            {
                if (!empty($items))
                {
                    $error = false;
                    break;
                }
            }
        }

        if($error)
            $this->addError($attribute,'Обязательно указать хотя бы один вариант ответа');
    }

    public function beforeSave()
    {
        if (parent::beforeSave())
        {
            if ($this->isNewRecord && !$this->finish)
                $this->finish = time();

            return TRUE;
        }

        return FALSE;
    }
    public function afterFind()
    {
        parent::afterFind();

        foreach ($this->items as $item)
        {
            $this->voteItems[$item->id] = $item->title;
        }

        $this->finish = date('Y-m-d H:i', $this->finish);
        $this->date_publish = date('Y-m-d H:i', $this->date_publish);
    }

    public function saveItems()
    {
        $error = !$this->save();

        foreach ($this->items as $item)
        {
            if (!$item->delete())
            {
                $this->addError('items', "Не удалось удалить вариант ответа {$item->title}");

                $error = true;
            }
        }

        foreach($this->voteItems as $key => $item)
        {
            if(!empty($item))
            {
                $model = new VoteItem();
                $model->vote_id = $this->id;
                $model->title = $item;
                $model->sort = $key;

                if (!$model->save())
                {
                    $this->addError('items', "Не удалось сохранить вариант ответа {$model->title}");

                    $error = true;
                }
            }
        }

        return !$error;
    }

    public function sorted($sort = 'DESC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "id {$sort}",
        ));

        return $this;
    }

    public function isActual()
    {
        return strtotime($this->finish) > time();
    }

    public function isClosedAndNonPublish()
    {
        if (!$this->closed)
            return false;

        return strtotime($this->date_publish) > time();
    }
}