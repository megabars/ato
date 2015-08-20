<?php

/**
 * This is the model class for table "afisha_conf".
 *
 * The followings are the available columns in table 'afisha_conf':
 * @property integer $id
 * @property integer $month_file
 * @property integer $quarter_file
 * @property integer $year_file
 */
class AfishaConf extends BaseActiveRecord
{
    /**
     * Файл с csv-содержимым создаваемого меню
     * @var string
     */
    public $fileId;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AfishaConf the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'afisha_conf';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('month_file, quarter_file, year_file', 'numerical', 'integerOnly'=>true),

            array('fileId', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, month_file, quarter_file, year_file, fileId', 'safe', 'on'=>'search'),
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
			'month_file' => 'План на месяц',
			'quarter_file' => 'План на квартал',
			'year_file' => 'План на год',
            'fileId' => 'CSV файл <br><strong>Структура:</strong> Дата; Время; Содержание мероприятия; Ответственные; Место проведения; Кол-во уч-ков.<br><strong>Кодировка:</strong> utf-8.'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('month_file',$this->month_file);
		$criteria->compare('quarter_file',$this->quarter_file);
		$criteria->compare('year_file',$this->year_file);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    /**
     * Обработчик прикрепленного файла CSV для загрузки мероприятий
     * @var $saveData bool флаг валидировать или сохранять...
     */
    public function checkFile($saveData = false) {

        if (!empty($this->fileId) && ($file = File::model()->findByPk($this->fileId)) !== null) {

            $path = $file->getFilePath();
//            $path = Yii::app()->basePath.'/..'.self::getUploadFolder().$file->name;

            if (file_exists($path)) {
                $fp = fopen($path,'r');

                $data = array();

                while (($filePart = fgetcsv($fp, 0, ';')) !== false)
                    $data[]=$filePart;

                fclose($fp);

                array_shift($data);

                // распарсился?
                if ($data === false) {
                    $this->addError('fileId', 'Возможно файл поврежден');
                } elseif ($saveData) {

                    $point = false;
                    foreach ($data as $item) {

                        // Если первое значение строки дата или диапазон дат, то парсим строку
                        if((strtotime($item[0]) && count($item) > 3 && array_search(iconv_strlen($item[0]), range(8,10))!==false) || (strpos($item[0],'-')!==false && array_search(iconv_strlen($item[0]), range(17,21))!==false)){

                            $point = true;

                            if($this->get_encoding($item[2])!=='utf-8') { // если кодировка не utf-8
                                $this->addError('fileId', 'Кодировка файла должна быть utf-8');
                                break;
                            }

                            list($origin_date, $origin_time, $title, $organizer, $place, $participant) = $item;
                            $date = '';
                            $duration = '';

                            if(iconv_strlen($title)>255)
                                $title = mb_substr($title, 0, 255, 'utf-8');

                            // Парсим время
                            if (!empty($origin_time)) {
                                $origin_time = explode('-', $origin_time);

                                if (strpos($origin_time[0], '.') === false)
                                    $origin_time[0] = $origin_time[0].'00';

                                $date = $origin_time[0];
                                $duration = @$origin_time[1];
                            }

                            // Парсим дату
                            if (!empty($origin_date)) {

                                $origin_date = explode('-', $origin_date);
                                $date = $origin_date[0].' '.$date;

                                if(isset($origin_time[1]))
                                    $duration = @$origin_date[0].' '.$duration;
                                else
                                    $duration = @$origin_date[1].' '.$duration;
                            }

                            $model = new Afisha();
                            $model->attributes = array(
                                'title' => trim($title), // Наименование
                                'place' => trim($place), // Место проведения
                                'date' => (int)strtotime(trim($date)), // Дата и время начала
                                'duration' => (int)strtotime(trim($duration)), // Дата и время окончания
                                'organizer' => trim($organizer), // Организатор
                                'participant' => trim($participant), // Количество участников
                                'state' => 1, // Опубликовано
                                'state_date' => time(), // Дата публикации
                            );

                            if(!$model->save()) {
                                $this->addError('fileId', 'Ошибка записи в БД. Обратитесь к администратору');
                                break;
                            }
                        } else {
                            continue;
                        }
                    }
                    if(!$point) //Значит ни одна строка не подошла для парсинга
                        $this->addError('fileId', 'Некорректный формат файла. Нет данных для сохранения');

                    @unlink($path); // удаляем сам файл
                    $file->delete();
                }
            } else {
                $this->addError('fileId', 'Не удалось открыть файл, попробуйте загрузить еще раз');
            }
        }

//        else {
//            $this->addError('fileId', 'Не удалось открыть файл, попробуйте загрузить еще раз');
//        }
    }

    public function beforeSave(){
        if (!parent::beforeSave())
            return false;

        $this->checkFile(true);
        if ($this->getError('fileId'))
            return false ;
        else
            return true;

    }

    protected function get_encoding($str){
        $cp_list = array('utf-8', 'windows-1251');
        foreach ($cp_list as $k=>$codepage){
            if (md5($str) === md5(@iconv($codepage, $codepage, $str))){
                return $codepage;
            }
        }
        return null;
    }
}