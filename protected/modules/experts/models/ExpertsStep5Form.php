<?php

/**
 * Регистрация эксперта
 * Class ExpertsStep5Form
 */
class ExpertsStep5Form extends CFormModel
{
    public $professional_interests; //r
    public $skill; //r
    public $experience; //r
    public $achievements;

    public $interests_list;

    public function __construct()
    {
        $this->interests_list = array(
            'Благотворительность',
            'Государственная гражданская и муниципальная служба',
            'Дошкольное образование',
            'Жилищно-коммунальное хозяйство',
            'Здравоохранение',
            'Инвестиционная деятельность',
            'Информатизация и связь',
            'Культура',
            'Международное сотрудничество',
            'Местное самоуправление',
            'Молодежная политика',
            'Налоговая политика',
            'Наука и высшее профессиональное образование',
            'Национальная политика',
            'Недропользование',
            'Некоммерческие организации',
            'Общее образование',
            'Охота, рыболовство и рыбоводство',
            'Охрана окружающей среды',
            'Пассажирские и грузовые перевозки',
            'Предпринимательство',
            'Природопользование',
            'Промышленность',
            'Сельское хозяйство и животноводство',
            'Социальная защита населения',
            'Среднее профессиональное образование',
            'Средства массовой информации',
            'Строительство и архитектура',
            'Тарифное регулирование',
            'Территориальное планирование',
            'Торговля и сфера услуг',
            'Транспортная инфраструктура',
            'Туризм',
            'Физическая культура и спорт',
            'Экономика',
            'Энергетика',
        );
        parent::__construct();
    }

    public function rules()
    {
        return array(
            array('professional_interests, skill, experience', 'required'),
            array('professional_interests', 'interestsValidate'),
            array('experience', 'experienceValidate'),
            array('professional_interests, skill, experience, achievements','safe')
        );
    }
    public function interestsValidate($attribute) {
        if (is_array($this->$attribute)) {
            $countText = 0;
            $count = 0;
            foreach ($this->$attribute as $key=>$value) {
                if($key==='text') {
                    foreach($value as $text) {
                        if(trim($text) != '')
                            $countText++;
                    }
                } else {
                    if(trim($value) != '')
                        $count++;
                }
            }
            if($count==0 && $countText == 0)
                $this->addError($attribute, 'Необходимо выбрать хотя бы 1 сферу профессиональных интересов');
        }
    }

    public function experienceValidate($attribute) {
        if (is_array($this->$attribute)) {

            $lines = Experts::arraySortingToLine($this->$attribute);

            // собираем данные по полям строк
            $filledLines = 0;
            $emptyFields = array();
            foreach($lines as $line => $fields) {
                foreach($fields as $field=>$value) {
                    if(trim($value)=='')
                        $emptyFields[$line][]=$field;
                }
                if(@count($emptyFields[$line])==0)
                    $filledLines++;

            }

            // валидация
            if(count($emptyFields)>0)  {
                foreach($emptyFields as $emptyLine => $emptyField){
                    if(count($emptyField)<count($this->$attribute)) {
                        $this->addError("{$attribute}", 'Все поля в строке должны быть заполнены');
                        foreach($emptyField as $field)
                            $this->addError("{$attribute}[{$field}][{$emptyLine}]", 'Нужно заполнить поле');
                    }
                    if(count($emptyField)==count($this->$attribute) && in_array($emptyLine, array(1,2,3)) && $filledLines<3) {
//                        $this->addError("{$attribute}", 'Необходимо указать не менее 3-х мест работы');
                        foreach($emptyField as $field)
                            $this->addError("{$attribute}[{$field}][{$emptyLine}]", 'Нужно заполнить поле');
                    }
                }
            }
        }
    }


    public function attributeLabels()
    {
        return array(
            'professional_interests' => 'Сфера профессиональных интересов',
            'skill' => 'Ключевые профессиональные компетенции',
            'experience' => 'Опыт работы (три последних места работы начиная с текущего)',
            'achievements' => 'Основные профессиональные достижения за последние три года',
        );
    }
}
