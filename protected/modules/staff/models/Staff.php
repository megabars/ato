<?php

/**
 * This is the model class for table "staff".
 *
 * The followings are the available columns in table 'staff':
 * @property string $id
 * @property integer $portal_id
 * @property string $title
 * @property integer $contest_type
 * @property integer $date
 * @property integer $date_actual
 * @property string $organization
 * @property integer $group
 * @property integer $category
 * @property string $responsibility
 * @property integer $education_level
 * @property integer $education_direction
 * @property integer $expirience
 * @property string $knowledge
 * @property string $skill
 * @property double $amount_min
 * @property double $amount_max
 * @property string $contract
 * @property string $additional
 * @property string $acts
 * @property string $documents
 * @property string $contact
 * @property string $contest_result
 * @property string $contest_date
 * @property string $paper
 * @property string $org_address
 * @property string $doc_address
 * @property string $org_characteristic
 * @property string $labor_condition
 * @property string $type
 * @property string $state
 */
class Staff extends BaseActiveRecord
{
    public $amount;

    public $search_date;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'staff';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('portal_id, file', 'required'),
            array('contest_type, date, date_actual', 'numerical', 'integerOnly' => TRUE),
            array('amount_min, amount_max', 'numerical'),
            array('title, organization', 'length', 'max' => 255),
            array('responsibility, knowledge, skill, contract, additional, acts, documents, contact, contest_result', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, portal_id, file, title, contest_type, date, date_actual, organization, group, category, responsibility, education_level, education_direction, expirience, knowledge, skill, amount_min, amount_max, contract, additional, acts, documents, contact, contest_result, amount, search_date, state, result, result_file', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'portal_id' => 'Орган власти',
            'title' => 'Заголовок',
            'contest_type' => 'Тип конкурса',
            'date' => 'Дата',
            'date_actual' => 'Срок подачи документов',
            'organization' => 'Наименование органа власти',
            'group' => 'Группа должностей',
            'category' => 'Категория должностей',
            'responsibility' => 'Обязанности',
            'education_level' => 'Образование',
            'education_direction' => 'Направление образования',
            'expirience' => 'Стаж работы',
            'knowledge' => 'Знания',
            'skill' => 'Навыки',
            'amount_min' => 'Минимальная заработная плата',
            'amount_max' => 'Максимальная заработная плата',
            'contract' => 'Контракт',
            'additional' => 'Дополнительная информация',
            'acts' => 'Нормативно-правовые акты',
            'documents' => 'Документы представляемые в конкурсную комиссию',
            'contact' => 'Контактная информация',
            'contest_result' => 'Информация об итогах конкурса',
            'file' => 'Файл',
            'amount' => 'Уровень заработной платы',
            'state' => 'Статус',
            'result' => 'Результаты',
            'result_file' => 'Файл результатов',
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
        $encoding = 'utf-8';
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, TRUE);
        $criteria->compare('portal_id', $this->portal_id);
        $criteria->compare('title', $this->title, TRUE);
        $criteria->compare('contest_type', $this->contest_type);
        $criteria->compare('date', $this->date);
        $criteria->compare('date_actual', $this->date_actual);
        $criteria->compare('organization', $this->organization, TRUE);
        $criteria->compare('t.group', mb_strtolower($this->group, $encoding), TRUE);
        $criteria->compare('category', mb_strtolower($this->category, $encoding), TRUE);
        $criteria->compare('responsibility', $this->responsibility, TRUE);
        $criteria->compare('education_level', mb_strtolower($this->education_level, $encoding), TRUE);
        $criteria->compare('education_direction', mb_strtolower($this->education_direction, $encoding), TRUE);
        $criteria->compare('expirience', mb_strtolower($this->expirience, $encoding), TRUE);
        $criteria->compare('knowledge', mb_strtolower($this->knowledge, $encoding), TRUE);
        $criteria->compare('skill', mb_strtolower($this->skill, $encoding), TRUE);
        $criteria->compare('contract', mb_strtolower($this->contract, $encoding), TRUE);
        $criteria->compare('additional', $this->additional, TRUE);
        $criteria->compare('acts', $this->acts, TRUE);
        $criteria->compare('documents', $this->documents, TRUE);
        $criteria->compare('contact', $this->contact, TRUE);
        $criteria->compare('contest_result', $this->contest_result, TRUE);
        $criteria->compare('state', $this->state);

//        if ($this->amount)
//            $criteria->addCondition("amount_min <= {$this->amount} AND amount_max >= {$this->amount}");

//        if ($this->amount_min)
//            $criteria->addCondition("amount_min >= {$this->amount_min}");
//        if ($this->amount_max)
//            $criteria->addCondition("amount_max <= {$this->amount_max}");

        if ($this->amount_min)
            $criteria->addCondition("(amount_min <= {$this->amount_min} AND amount_max >= {$this->amount_min})", "OR");

        if ($this->amount_max)
            $criteria->addCondition(" (amount_min <= {$this->amount_max} AND amount_max >= {$this->amount_max})", "OR");

        if ($this->search_date)
        {
            $date = (time() - $this->search_date * 3600 * 24);

            $criteria->addCondition("date > {$date}");
        }


        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'date DESC',
            )
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Staff the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function beforeValidate()
    {
        if (!$this->title)
            $this->addError('file', 'Неправильный формат файла');

        return parent::beforeValidate();
    }

    /**
     * Получение списка всех направлений
     * @return array
     */
    static public function getPossibleDirections()
    {
        $directions = array();

        foreach (self::model()->findAll() as $staff)
        {
            foreach (explode(',', $staff->education_direction) as $item)
            {
                $item = trim($item);

                if ($item != 'нет' && !in_array($item, $directions))
                    $directions[$item] = $item;
            }
        }

        return $directions;
    }

    /**
     * Получение списка всех организаций
     * @return array
     */
    static public function getPossibleOrganization()
    {
        $orgs = array();

        foreach (self::model()->findAll() as $staff)
        {
            if (!in_array($staff->organization, $orgs))
                $orgs[$staff->organization] = $staff->organization;
        }

        return $orgs;
    }
}
