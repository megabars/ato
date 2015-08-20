<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые данные';

$this->breadcrumbs = array(
    'Открытые данные'
);
?>

<div class="wrap opendata">
    <h2>Открытые данные</h2>
    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <a href="/opendata">Данные</a>
                <a href="">О проекте</a>
                <a href="">Условия использования</a>
                <a href="/opendata/form">Обратная связь</a>
                <a href="">Разработчикам</a>
                <a href="">Приложения и программы</a>
                <a href="/opendata/statistic" class="active">Статистика</a>
            </div>
        </div>
        <div class="left-content">
            <h3>Статистика</h3>

            <div class="custom-content min-space mt10">
                <p><b>Количество организаций, предоставивших открытые данные:</b> 31</p>
                <p><b>Количество наборов данных:</b> 98</p>
            <p><b>Количество открытых данных:</b> 2311</p>
            </div>

            <div class="collapses mt30">
                <div class="item active">
                    <div class="title">
                        <div class="name">Статистика по ИОГВ</div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>ИОГВ</th>
                                    <th>Кол-во наборов</th>
                                    <th>Заполненность наборов</th>
                                    <th>Заполненность паспортов</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Статистика по ЖКХ</td>
                                    <td>23</td>
                                    <td>95%</td>
                                    <td>55</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="item active">
                    <div class="title">
                        <div class="name">
                            Статистика по наборам данных
                        </div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Просмотрено</th>
                                    <th>Скачено</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</td>
                                    <td>23</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</td>
                                    <td>33</td>
                                    <td>15</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</td>
                                    <td>55</td>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</td>
                                    <td>36</td>
                                    <td>11</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</td>
                                    <td>95</td>
                                    <td>37</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

