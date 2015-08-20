<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Кадрвая политика';

$this->breadcrumbs = array(
    'Кадрвая политика'
);
?>

<div class="wrap">
    <h2>Кадрвая политика</h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="" class="active">Вакансии</a>
                <a href="">Как поступить на госслужбу</a>
                <a href="">Государственная гражданская служба</a>
                <a href="">Кадровые резервы Томской области</a>
                <a href="">Дополнительное профессиональное образование государственных гражданских служащих</a>
                <a href="">Награды</a>
                <a href="">Президентская программа подготовки управленческих кадров для организаций народного хозяйства Российской Федерации</a>
            </div>
        </div>

        <div class="left-content">

            <h3>Вакансии</h3>

            <div class="grid-search">
                <div class="text-right"><a href="" id="toggle-search">расширенный поиск</a></div>

                <div class="search-min clearfix">
                    <button type="submit" class="btn-default">Искать</button>
                    <div>
                        <input type="text" placeholder="Например, дизайнер"/>
                    </div>
                </div>
                <div class="search-max">
                    <div class="row">
                        <label>Название вакансии</label>
                        <div>
                            <input type="text"/>
                        </div>
                    </div>
                    <div class="row">
                        <label>Группа вакантной должности</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Уровень образования</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Категория должностей</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Направление образования</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Стаж по специальности</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row price">
                        <label>Уровень заработной платы</label>
                        <input type="text"/> руб.
                    </div>
                    <div class="row">
                        <label>Вид конкурса</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>Статус конкурса</label>
                        <select class="select">
                            <option value="">Все</option>
                            <option value="">не все</option>
                        </select>
                    </div>
                    <div class="row">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn-default">Искать</button>
                        <a href="" class="hide">свернуть</a>
                    </div>
                </div>
            </div>

            <h4>
                Результат поиска
                <div class="filter-day">
                    за последние:
                    <a href="">3 дня</a>
                    <a href="">За неделю</a>
                    <a href="">За месяц</a>
                </div>
            </h4>

            <table class="table jobs">
                <thead>
                <tr>
                    <th>Должность</th>
                    <th>Дата</th>
                    <th class="last">Зарплата</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                <a href="">Ведущий инспектор</a>
                            </div>
                            Контрольно-счетная палата Томской области<br/>
                            г. Томск
                        </td>
                        <td>
                            17 декабря<br/>
                            2014
                        </td>
                        <td>
                            12000 - 15000 руб.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <a href="">Ведущий инспектор</a>
                            </div>
                            Контрольно-счетная палата Томской области<br/>
                            г. Томск
                        </td>
                        <td>
                            17 декабря<br/>
                            2014
                        </td>
                        <td>
                            12000 - 15000 руб.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <a href="">Ведущий инспектор</a>
                            </div>
                            Контрольно-счетная палата Томской области<br/>
                            г. Томск
                        </td>
                        <td>
                            17 декабря<br/>
                            2014
                        </td>
                        <td>
                            12000 - 15000 руб.
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

