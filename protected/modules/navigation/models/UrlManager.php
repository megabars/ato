<?php

/**
 * This is the model class for table "url_manager".
 *
 * The followings are the available columns in table 'url_manager':
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $meta_description
 * @property string $meta_keywods
 */
class UrlManager extends BaseActiveRecord
{
    public function __toString(){
        return $this->url;
    }

    /**
     * Модуль обращения сделан статической страницей, возвращает эту страницу.
     * Создает её, если нет
     * @return StaticPage|static
     * @throws CHttpException
     */
    public static function getAppealPage(){

        $static = null;

        /** @var $url UrlManager */
        $url = modelFactory::get('UrlManager', array('url'=>'appeal/front'));

        if (!$url->isNewRecord) {
            $static = StaticPage::model()->findByAttributes(array('url_id'=> $url->id));
        }

        // создаем страницу если нет такой
        if ($static == null) {
            if (!$url->save())
                throw new CHttpException(500, 'Cant save url, error is: '.print_r($url->getErrors(), true));

            $static = new StaticPage();
            $static->attributes = array(
                'title' => "Модуль Обращения",
                'url_id' => $url->id,
                'state' => 1,
                'date' => date('Y-m-d H:m:s')
            );

            if (!$static->save())
                throw new CHttpException(500, 'Cant save static page, error is: '.print_r($static->getErrors(), true));

        }

        return $static;
    }

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'url_manager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('portal_id', 'required'),
//            array('url', 'unique'),
            array('url', 'match', 'pattern' => '/^[0-9A-Za-z-\/\.:]+$/u', 'message' => 'В этом поле резрешено использование только латинских букв и тире'),
			array('url, title', 'length', 'max'=>255),
            array('url', 'uniqueUrlAndPortal', 'message' => 'Данный адрес страницы уже используется. Попробуйте ввести уникальный адрес'),
			array('meta_description, meta_keywods', 'length', 'max'=>500),
            array('portal_id', 'numerical', 'integerOnly' => true),
            array('url', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, url, title, meta_description, meta_keywods', 'safe', 'on'=>'search'),
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
			'url' => 'Адрес',
			'title' => 'Заголовок страницы',
			'meta_description' => 'Описание страницы (Meta Description)',
			'meta_keywods' => 'Ключевые слова (Meta Keywods)',
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
		$criteria->compare('url',$this->url,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('meta_description',$this->meta_description,true);
		$criteria->compare('meta_keywods',$this->meta_keywods,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UrlManager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function uniqueUrlAndPortal($attribute, $params=array())
    {
        $params['criteria'] = array(
            'condition' => 'portal_id=:id',
            'params' => array(':id' => $this->portal_id),
        );

        $validator = CValidator::createValidator('unique', $this, $attribute, $params);

        $validator->validate($this, array($attribute));
    }
}
