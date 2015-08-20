<?php

Yii::import('zii.widgets.CMenu');

class servicesWidget extends CWidget
{
    public $menu_alias = 'services';

    /** @var array Массив с названиями и id картинки, которая соответсвует этому названию */
    public $possibleNames = array(
        // используется на субпорталах экспертных советов
        'База данных экспертов'      => 1,
        'Зарегистрироваться как эксперт' => 1,

        'Экспертное обсуждение'      => 2,
        'Задать вопрос'              => 3,

        // а это на субпорталах ИОГВ
        'Обращения граждан'          => 4,
        'Кадровая политика'          => 5,
        'Противодействие коррупции'  => 6,
        'Открытые данные'            => 7,
        'Информационные системы'     => 8,
        'Проверки'                   => 9,
        'Статистика'                 => 10,
        'Аукционы и конкурсы'        => 11,
    );

    public function run()
    {
        $criteria = new CDbCriteria();
        $criteria->with = array('menu');
        $criteria->addCondition("parent_id = 0");
        $criteria->addCondition("menu.alias = '{$this->menu_alias}'");
        $criteria->addCondition("state = 1");
        $criteria->order = 'ordi ASC';

        $this->render('services', array(
            'records' => NavItems::model()->findAll($criteria),
        ));
    }
}