<?php

/**
 * This is the model class for table "log".
 *
 * The followings are the available columns in table 'log':
 * @property integer $id
 * @property string $changedModel
 * @property string $typeOfChange
 * @property integer $userId
 * @property integer $date
 * @property integer $recordId
 */
class Log extends BaseActiveRecord
{
    public function behaviors(){
        return array(
            'DateFieldBehavior' => array(
                'class'  => 'DateFieldBehavior'
            )
        );
    }

    public function beforeSave(){
        return true;
    }

    public function afterFind(){
        parent::afterFind();

        switch ($this->typeOfChange) {
            case 'delete':
                $this->typeOfChange = 'Удаление';
                break;

            case 'update':
                $this->typeOfChange = 'Изменение';
                break;

            case 'create':
                $this->typeOfChange = 'Новая запись';
                break;

        }

        $modules = $this->getModules();

        foreach ($modules as $module) {
            foreach($module['models'] as $name => $model) {
                if ($this->changedModel == $model)
                    $this->changedModel = $module['name'].": ".$name;
            }
        }

        $this->userId = @User::model()->findByPk($this->userId)->username;
    }
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userId, date, recordId', 'numerical', 'integerOnly'=>true),
			array('changedModel, typeOfChange', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, changedModel, typeOfChange, userId, date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'changedModel' => 'Раздел',
			'typeOfChange' => 'Тип изменения',
			'userId' => 'Пользователь',
			'date' => 'Дата',
			'recordId' => 'ID записи',
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
		$criteria->compare('"changedModel"',$this->changedModel,true);
		$criteria->compare('"typeOfChange"',$this->typeOfChange);
		$criteria->compare('"userId"',$this->userId);
		$criteria->compare('"recordId"',$this->recordId);

        if(!empty($this->date)) {
            $startDate = strtotime($this->date);
            $endDate = strtotime($this->date) + 86400;
            $criteria->addCondition("date>=".$startDate." AND date<=".$endDate);
        }

        $criteria->order = 'id DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>15,
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Log the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    /**
     * Returns the modules list with models.
     * @return array()
     */
	public static function getModules()
	{
		return array(
            'afisha' => array(
                'name' => 'Календарь мероприятий',
                'models' => array(
                    'Список мероприятий' => 'Afisha'
                ),
            ),
            'antiCorruption' => array(
                'name' => 'Противодействие коррупции',
                'models' => array(
                    'Нормативно-правовые акты' => 'AcDocument',
                    'Независимая антикоррупциионная экспертиза' => 'AcExpertise',
                    'Файлы' => 'AcFile',
                    'Состав комиссии' => 'AcMembers',
                    'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера' => 'AcPublic',
                    'План работы' => 'AcSchedule'
                ),
            ),
            'appeal' => array(
                'name' => 'Обращения граждан',
                'models' => array(
                    'Место, время и порядок приема' => 'AppealPlace',
                    'Обзор обращений' => 'AppealReview',
                    'График приема граждан' => 'AppealSchedule'
                ),
            ),
            'audio' => array(
                'name' => 'Аудио',
                'models' => array(
                    'Аудиоархив' => 'Audio'
                ),
            ),
            'comments' => array(
                'name' => 'Комментарии',
                'models' => array(
                    'Комментарии' => 'Comment'
                ),
            ),
            'contact' => array(
                'name' => 'Контактная информация',
                'models' => array(
                    'Список ИОГВ' => 'Contact',
                    'Контактные данные' => 'ContactDetails'
                ),
            ),
            'contests' => array(
                'name' => 'Открытые конкурсы',
                'models' => array(
                    'Список открытых конкурсов' => 'Contest'
                ),
            ),
            'discuss' => array(
                'name' => 'Обсуждение законопроектов',
                'models' => array(
                    'Список обсуждений' => 'Discuss'
                ),
            ),
            'documents' => array(
                'name' => 'Документы',
                'models' => array(
                    'Список документов' => 'Documents',
                    'Папки' => 'DocumentsFolder',
                    'Группы папок' => 'FoldersGroup'
                ),
            ),
            'faqs' => array(
                'name' => 'Часто задаваемые вопросы',
                'models' => array(
                    'Список вопросов' => 'Faqs'
                ),
            ),
            'feedback' => array(
                'name' => 'Обратная связь',
                'models' => array(
                    'Список заявок' => 'Feedback',
                    'Горячие линии' => 'Hotlines'
                ),
            ),
            'government' => array(
                'name' => 'Исполнительные органы государственной власти',
                'models' => array(
                    'Список ИОГВ 1' => 'Government',
                    'Категория должности 1' => 'GovernmentType',
                    'Список ИОГВ 2' => 'Executive',
                    'Категория должности 2' => 'CategoryPost'
                ),
            ),
            'gubernator' => array(
                'name' => 'Губернатор',
                'models' => array(
                    'Фразы губернатора' => 'Gubernator'
                ),
            ),
            'links' => array(
                'name' => 'Ссылки',
                'models' => array(
                    'Группы ссылок' => 'LinksGroup'
                ),
            ),
            'mailing' => array(
                'name' => 'Почтовые рассылки',
                'models' => array(
                    'Список e-mail' => 'MailEmailList',
                    'Группы рассылок' => 'MailGroup',
                    'Список e-mail группы рассылок' => 'MailGroupEmailList',
                    'Подписчики' => 'MailSubscribe',
                    'Файлы подписчиков' => 'MailSubscribeFiles',
                    'E-mail шаблоны' => 'MailTemplate'
                ),
            ),
            'navigation' => array(
                'name' => 'Навигация',
                'models' => array(
                    'Элементы меню' => 'NavItems',
                    'Меню' => 'NavMenu'
                ),
            ),
            'news' => array(
                'name' => 'Новости',
                'models' => array(
                    'Список новостей' => 'News',
                    'Категории новостей' => 'NewsType',
                    'Подписчики' => 'NewsSubscribers'
                ),
            ),
            'events' => array(
                'name' => 'События региона',
                'models' => array(
                    'Список событий' => 'Event',
                ),
            ),
            'opendata' => array(
                'name' => 'Открытые данные',
                'models' => array(
                    'Список данных' => 'Opendata',
                    'Версия данных' => 'OpendataVersion'
                ),
            ),
            'pages' => array(
                'name' => 'Управление страницами',
                'models' => array(
                    'Список страниц' => 'StaticPage',
                    'Список ИОГВ' => 'PageExecutives',
                    'Список фактов' => 'PageFacts',
//                    'Фотогалерея' => 'PageGallery',
                ),
            ),
            'people' => array(
                'name' => 'Персоналии',
                'models' => array(
                    'Список персон' => 'People',
                    'Категории должностей' => 'PeopleStaff',
                    'Данные персон' => 'PeopleUnit'
                ),
            ),
            'photoGallery' => array(
                'name' => 'Фотогалерея',
                'models' => array(
                    'Список фотогалерей' => 'PhotoGallery',
                    'Список фотографий' => 'PhotoGalleryPhotos'
                ),
            ),
            'portals' => array(
                'name' => 'Управление субпорталами',
                'models' => array(
                    'Субпорталы' => 'Portal'
                ),
            ),
            'publicReport' => array(
                'name' => 'Формы публичной отчетности',
                'models' => array(
                    'Список файлов' => 'PublicReport'
                ),
            ),
            'rating' => array(
                'name' => 'Оценка регулирующего воздействия и экспертиза НПА',
                'models' => array(
                    'Документы' => 'RatingDoc',
                    'Файлы' => 'RatingProjectFile'
                ),
            ),
            'smi' => array(
                'name' => 'СМИ',
                'models' => array(
                    'Публикации' => 'Smi'
                ),
            ),
            'staff' => array(
                'name' => 'Кадровая политика',
                'models' => array(
                    'Сотрудники' => 'Staff'
                ),
            ),
            'stenogramm' => array(
                'name' => 'Стенограммы',
                'models' => array(
                    'Список стенограмм' => 'Stenogramm'
                ),
            ),
            'video' => array(
                'name' => 'Видеогалерея',
                'models' => array(
                    'Список видео' => 'VideoGalleryVideos'
                ),
            ),
            'vote' => array(
                'name' => 'Опросы',
                'models' => array(
                    'Список опросов' => 'Vote',
                    'Варианты ответов' => 'VoteItem',
                    'Проголосовавшие' => 'VoteUser'
                ),
            ),
            'experts' => array(
                'name' => 'Экспертные советы',
                'models' => array(
                    'Эксперты' => 'Experts',
                    'Данные экспертов' => 'ExpertsResources'
                ),
            ),
            'independentEvaluation' => array(
                'name' => 'Независимая оценка',
                'models' => array(
                    'Документы' => 'IeFile',
                    'Реализация независимой оценки' => 'IndependentEvaluation'
                ),
            ),
//            'files' => array(
//                'name' => 'Файловое хранилище',
//                'models' => array(
//                    'Файл' => 'File',
//                ),
//            ),
        );
	}
}
