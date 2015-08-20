<?php

/**
 * This is the model class for table "nav_menu".
 *
 * The followings are the available columns in table 'nav_menu':
 * @property integer $id
 * @property integer $portal_id
 * @property string $alias
 *
 * The followings are the available model relations:
 * @property NavItems[] $navItems
 */
class NavMenu extends BaseActiveRecord
{
    /**
     * Файл с csv-содержимым создаваемого меню
     * @var string
     */
    public $fileId;

    /**
     * Меню с такими алиасами юзаются на портале
     * @var array
     */
    public static $aliases = array(
        'main_menu' => 'Основное меню',
        'services' => 'Сервисы',
        'right_menu' => 'Правое меню главной страницы',
        'map_menu' => 'Меню карты',
    );

    /**
     * тот самый файл, только распарсили
     * @var array
     */
    private $_csvData = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nav_menu';
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
			array('alias', 'length', 'max'=>255),

            array('published, fileId, alias', 'safe'),

			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
			'navItems' => array(self::HAS_MANY, 'NavItems', 'menuId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'published' => 'Опубликовано',
            'fileId' => 'CSV формата: id;parentId;Назвение элемента',
            'alias' => 'Расположение меню'

		);
	}

    public function getCsvArray ($path) {

        if (!file_exists($path)) {
            return false;
        }

        if (count($this->_csvData) == 0) {
            $fp = fopen($path,'r');
            $data = array();

            while (($filePart = fgetcsv($fp, 0, ';')) !== false) {
                $data[]=$filePart;
            }

            fclose($fp);
            array_shift($data);

            $this->_csvData = $data;
        }

        return $this->_csvData;




    }


    /**
     * Обработчик прикрепленного файла с структурой навигации при создании меню тут...
     * @var $saveData bool флаг валидировать или сохранять...
     */
    public function checkFile($saveData = false) {
        if (!empty($this->fileId) && ($file = File::model()->resetScope()->findByPk($this->fileId)) !== null) {

//            echo "get file data\n";
            $path = $file->getFilePath();
//            $path = Yii::app()->basePath.'/..'.self::getUploadFolder().$file->name;

            $data = $this->getCsvArray($path);

            if ($data) {


                // распарсился? структура верная?
                if ($data === false OR count($data[0]) < 3) {
                    $this->addError('fileId', 'Некорректный формат файла');
                } elseif ($saveData) {

//                    echo "set file data\n";
                    $savedItemsMapper = array();

                    foreach ($data as $num => $item) {
                        list($id, $parentId, $name) = $item;


                        if (isset($item[3])) {
                            $url = $item[3];
                        } else {
                            // url - транслитирируем
                            $url = Transliterate::text($name);

                            // левые символы из урл тоже надо выкинуть...
                            $url = preg_replace('/\W/s', '-', $url);
                        }

                        $urlModel = new UrlManager();
                        $urlModel->portal_id = $this->portal_id;
                        $urlModel->url = $url;
                        $urlModel->save();

//                        echo "url model save\n";
                        $model = new NavItems();
                        $model->attributes = array(
                            'title' => $name,
                            'url_id' => $urlModel->id,
                            'state' => 1,
                            'menuId' => $this->id,
                            'ordi' => $num,
                            'parent_id' => (isset($savedItemsMapper[$parentId])) ? $savedItemsMapper[$parentId] : 0
                        );

                        // родители по умолчанию не являются ссылками
                        if ($model->parent_id == 0)
                            $model->is_link = 0;

//                        $page = new StaticPage();
//                        $page->attributes = array(
//                            'portal_id' => $this->portal_id,
//                            'title' => $name,
//                            'url_id' => $urlModel->id,
//                            'state' => 1,
//                            'date' => date('Y-m-d H:m:s')
//                        );
//                        $page->save();
//                        echo "static page save\n";

                        if ($model->resetScope()->save(false)) {
                            $savedItemsMapper[$id] = $model->id;
                        }
//                        echo "nav item save\n";
                    }

                    File::model()->deleteByPk($this->fileId);
                    @unlink($path);
                }



            } else {
                $this->addError('fileId', 'Не удалось открыть файл, обратитесь к поставщику ПО');
            }
        }
    }

    public function beforeSave(){
        if (!parent::beforeSave())
            return false;

        $this->checkFile();

        if ($this->hasErrors())
            return false;
        else
            return true;

    }

    public function afterSave(){
        parent::afterSave();
        $this->checkFile(true);
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
		$criteria->compare('alias',$this->alias,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NavMenu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
