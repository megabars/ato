<?php

/**
 * This is the model class for table "experts".
 *
 * The followings are the available columns in table 'experts':
 * @property integer $id
 * @property integer $state
 * @property integer $date
 * @property integer $expert_council_id
 * @property string $fio
 * @property integer $birthday
 * @property string $citizenship
 * @property string $address
 * @property integer $restriction
 * @property integer $photo
 * @property integer $degree
 * @property integer $academic
 * @property integer $honorary
 * @property integer $publishing_count
 * @property string $publishing
 * @property string $professional_interests
 * @property string $skill
 * @property string $achievements
 * @property string $prospect
 * @property string $public_organization
 * @property string $expert_work
 * @property string $wish
 * @property string $project
 * @property string $qualification
 * @property string $additional_information
 * @property integer $is_deleted
 * @property string $post
 */
class Experts extends BaseActiveRecord
{
    const STATUS_UNWATCHED = 0;
    const STATUS_REVIEW = 1;
    const STATUS_ACCEPTED = 2;

    public static $statuses = array(
        self::STATUS_UNWATCHED                  => 'Новая заявка',
        self::STATUS_REVIEW  => 'Заявка на рассмотрении',
        self::STATUS_ACCEPTED             => 'Заявка принята',
    );
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'experts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('state, date, expert_council_id, fio, birthday, citizenship, restriction, degree, academic, honorary, skill', 'required'),
			array('state, expert_council_id, restriction, photo, degree, academic, honorary, publishing_count', 'numerical', 'integerOnly'=>true),
			array('fio, citizenship', 'length', 'max'=>255),
			array('address, post', 'length', 'max'=>500),
			array('publishing, professional_interests, achievements, prospect, public_organization, expert_work, wish, project, qualification, additional_information', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, state, expert_council_id, fio, birthday, citizenship, address, restriction, photo, degree, academic, honorary, publishing_count, publishing, professional_interests, skill, achievements, prospect, public_organization, expert_work, wish, project, qualification, additional_information, post', 'safe', 'on'=>'search'),
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
            'expert_council' => array(self::BELONGS_TO, 'ExpertsHelper', 'expert_council_id'),
            'phones' => array(self::HAS_MANY, 'ExpertResources', 'expert_id', 'condition'=>'type='.ContactType::PHONE),
            'emails' => array(self::HAS_MANY, 'ExpertResources', 'expert_id', 'condition'=>'type='.ContactType::EMAIL),
            'sites' => array(self::HAS_MANY, 'ExpertResources', 'expert_id', 'condition'=>'type='.ContactType::WEB),
            'blogs' => array(self::HAS_MANY, 'ExpertResources', 'expert_id', 'condition'=>'type='.ContactType::BLOG),
            'socials' => array(self::HAS_MANY, 'ExpertResources', 'expert_id', 'condition'=>'type='.ContactType::SOCIAL),
            'education' => array(self::HAS_MANY, 'ExpertEducations', 'expert_id', 'condition'=>'additional IS NULL'),
            'additional_education' => array(self::HAS_MANY, 'ExpertEducations', 'expert_id', 'condition'=>'additional IS NOT NULL'),
            'experience' => array(self::HAS_MANY, 'ExpertExperience', 'expert_id'),
            'degrees' => array(self::HAS_MANY, 'ExpertRegalia', 'expert_id', 'condition'=>'type='.RegaliaType::DEGREE),
            'academics' => array(self::HAS_MANY, 'ExpertRegalia', 'expert_id', 'condition'=>'type='.RegaliaType::ACADEMIC),
            'honoraries' => array(self::HAS_MANY, 'ExpertRegalia', 'expert_id', 'condition'=>'type='.RegaliaType::HONORARY),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'state' => 'Статус',
			'date' => 'Дата заполнения',
			'expert_council_id' => 'Экспертный совет',
			'fio' => 'ФИО',
			'birthday' => 'Дата рождения',
			'citizenship' => 'Гражданство',
			'address' => 'Место проживания',
			'restriction' => 'Наличие решений суда, связанных с ограничениями прав',
			'photo' => 'Фотография',
			'degree' => 'Наличие ученой степени',
			'academic' => 'Наличие ученого звания',
			'honorary' => 'Наличие почетного звания (степени) ',
			'publishing_count' => 'Общее количество публикаций',
			'publishing' => 'Наиболее значимые публикации',
			'professional_interests' => 'Сфера профессиональных интересов',
			'skill' => 'Ключевые профессиональные компетенции',
			'achievements' => 'Основные профессиональные достижения за последние три года',
			'prospect' => 'Профессиональные перспективы',
			'public_organization' => 'Опыт участия в деятельности общественных организаций',
			'expert_work' => 'Опыт участия в экспертной работе (участие в качестве, члена рабочей группы, разработчика нормативных актов)',
			'wish' => 'Стремления при участии в работе Экспертного совета при заместителе Губернатора Томской области',
			'project' => 'Значимые проекты, с помощью которых удалось решить общественную проблему',
			'qualification' => 'Дополнительные сведения о квалификации, которые могут повлиять на окончательное решение при отборе в Экспертный совет при заместителе Губернатора Томской области',
			'additional_information' => 'Дополнительная информация',
			'post' => 'Должность в совете',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('state',$this->state);
		$criteria->compare('date',$this->date);
		$criteria->compare('expert_council_id',$this->expert_council_id);
		$criteria->compare('fio',$this->fio,true);
		$criteria->compare('birthday',$this->birthday);
		$criteria->compare('citizenship',$this->citizenship,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('restriction',$this->restriction);
		$criteria->compare('photo',$this->photo);
		$criteria->compare('degree',$this->degree);
		$criteria->compare('academic',$this->academic);
		$criteria->compare('honorary',$this->honorary);
		$criteria->compare('publishing_count',$this->publishing_count);
		$criteria->compare('publishing',$this->publishing,true);
		$criteria->compare('professional_interests',$this->professional_interests,true);
		$criteria->compare('skill',$this->skill,true);
		$criteria->compare('achievements',$this->achievements,true);
		$criteria->compare('prospect',$this->prospect,true);
		$criteria->compare('public_organization',$this->public_organization,true);
		$criteria->compare('expert_work',$this->expert_work,true);
		$criteria->compare('wish',$this->wish,true);
		$criteria->compare('project',$this->project,true);
		$criteria->compare('qualification',$this->qualification,true);
		$criteria->compare('additional_information',$this->additional_information,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('post',$this->post);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Experts the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function behaviors()
    {
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior',
                'fields' => array('date', 'birthday')
            ),
            'ImageBehavior' => array(
                'class'  => 'ImageBehavior',
                'module' => 'news',
                'fields' => array(
                    array(
                        'field' => 'photo',
                        'small'  => array('width' => 90, 'height' => 120),
                        'medium' => array('width' => 180, 'height' => 240),
                    ),
                ),
            ),
        );
    }

    public static function arraySortingToLine($data, $full = true) {
        if (is_array($data)) {
            $lines = array();
            $emptyLine = array();
            // собираем массив в удобный вид (по строкам)
            foreach ($data as $key => $value) {
                foreach ($value as $valueKey => $valueItem)
                    if($full) {
                        $lines[$valueKey][$key] = $valueItem;
                    } else {
                        if(trim($valueItem)!='')
                            $lines[$valueKey][$key] = $valueItem;
                        else
                            $emptyLine[]=$valueKey;
                    }
            }
            // удаляем строки с пустыми элементами
            if(count($emptyLine)>0 && !$full){
                foreach($emptyLine as $line)
                    unset($lines[$line]);
            }

            return $lines;
        } else {
            return $data;
        }
    }

    public function unwatched() {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.state = '.self::STATUS_UNWATCHED,
        ));

        return $this;
    }

    public function review() {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.state = '.self::STATUS_REVIEW,
        ));

        return $this;
    }

    public function accepted() {
        $this->getDbCriteria()->mergeWith(array(
            'condition' => 't.state = '.self::STATUS_ACCEPTED,
        ));

        return $this;
    }

    public function sorted($sort = 'DESC')
    {
        $this->getDbCriteria()->mergeWith(array(
            'order' => "t.fio {$sort}",
        ));

        return $this;
    }

    public function getContact($type = 'phones') {
        $contacts = array();
        if(count($this->$type)) {
            foreach($this->$type as $contact) {
                $value = (
                    $contact->type == ContactType::WEB
                    || $contact->type == ContactType::BLOG
                    || $contact->type == ContactType::SOCIAL
                ) ? CHtml::link($contact->value, $contact->value) : ((
                    $contact->type == ContactType::EMAIL
                ) ? CHtml::link($contact->value, 'mailto:'.$contact->value) : CHtml::link($contact->value, 'callto:'.$contact->value));

                $contacts[] = $value;
            }
        }
        return implode(', ', $contacts);
    }
}
