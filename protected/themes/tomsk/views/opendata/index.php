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
                <a href="/opendata" class="active">Данные</a>
                <a href="">О проекте</a>
                <a href="">Условия использования</a>
                <a href="/opendata/form">Обратная связь</a>
                <a href="">Разработчикам</a>
                <a href="">Приложения и программы</a>
                <a href="/opendata/statistic">Статистика</a>
            </div>
        </div>
        <div class="left-content">

            <div class="left">
                <div class="checked-list">
                    <div class="collapsed">
                        <div class="title">Категории</div>
                        <div class="body">
                            <ul id="checked-sort">
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Летние наборы данных (16)</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Зимние наборы данных (8)</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Государственные услуги (6)</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Дороги и транспорт (41)</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="collapsed">
                        <div class="title">ОИГВ</div>
                        <div class="body">
                            <ul id="checked-sort">
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Устав Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Областные законы</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Постановления Законодательной Думы Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Постановления Законодательной Думы Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Постановления Администрации Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Распоряжения Администрации Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Постановления Губернатора Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Распоряжения Губернатора Томской области</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Приказы</span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input type="checkbox" data-id="" class="styled"/>
                                        <span class="label">Распоряжения ИОГВ</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">

                <div class="search-left-content">
                    <div class="info">
                        <div class="download">Скачать реестр: <a href="">csv (2.9 мб)</a>, <a href="">rdf-xml (3.7 мб)</a></div>
                        <div class="count">1547 документа</div>
                    </div>
                    <form action="">
                        <button type="submit" class="btn-default">Искать</button>
                        <div class="input"><input type="text"/></div>
                    </form>
                </div>

                <div class="result">
                    <div>Результат поиска</div>
                    найдено: 157 документов
                </div>

                <div class="data-list">
                    <ul>
                        <li>
                            <div class="item">
                                <div class="categories">Летние наборы данных</div>
                                <div class="title">
                                    <a href="/opendata/view">База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</a>
                                </div>
                                <div class="desc">
                                    Инспекция Тульской области по государственному архитектурно-строительному надзору
                                </div>
                                <div class="download-files">
                                    Скачать документ:
                                    <a href="">csv (2.9 мб)</a>,
                                    <a href="">zip (3.7 мб)</a>,
                                    <a href="">pdf (3.7 мб)</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="categories">Летние наборы данных</div>
                                <div class="title">
                                    <a href="/opendata/view">База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</a>
                                </div>
                                <div class="desc">
                                    Инспекция Тульской области по государственному архитектурно-строительному надзору
                                </div>
                                <div class="download-files">
                                    Скачать документ:
                                    <a href="">csv (2.9 мб)</a>,
                                    <a href="">zip (3.7 мб)</a>,
                                    <a href="">pdf (3.7 мб)</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="categories">Летние наборы данных</div>
                                <div class="title">
                                    <a href="/opendata/view">База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</a>
                                </div>
                                <div class="desc">
                                    Инспекция Тульской области по государственному архитектурно-строительному надзору
                                </div>
                                <div class="download-files">
                                    Скачать документ:
                                    <a href="">csv (2.9 мб)</a>,
                                    <a href="">zip (3.7 мб)</a>,
                                    <a href="">pdf (3.7 мб)</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="categories">Летние наборы данных</div>
                                <div class="title">
                                    <a href="/opendata/view">База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</a>
                                </div>
                                <div class="desc">
                                    Инспекция Тульской области по государственному архитектурно-строительному надзору
                                </div>
                                <div class="download-files">
                                    Скачать документ:
                                    <a href="">csv (2.9 мб)</a>,
                                    <a href="">zip (3.7 мб)</a>,
                                    <a href="">pdf (3.7 мб)</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="categories">Летние наборы данных</div>
                                <div class="title">
                                    <a href="/opendata/view">База данных перечень субстанций и (или) методов, запрещенных для использования в спорте</a>
                                </div>
                                <div class="desc">
                                    Инспекция Тульской области по государственному архитектурно-строительному надзору
                                </div>
                                <div class="download-files">
                                    Скачать документ:
                                    <a href="">csv (2.9 мб)</a>,
                                    <a href="">zip (3.7 мб)</a>,
                                    <a href="">pdf (3.7 мб)</a>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="pager">
                        <ul id="yw0" class="yiiPager">
                            <li class="first hidden"><a href="/documents/front/index/menuItem/1625"></a></li>
                            <li class="previous hidden"><a href="/documents/front/index/menuItem/1625"></a><a href="/documents/front/index/menuItem/1625">←&nbsp;&nbsp;Предыдущая</a></li>
                            <li class="page selected"><a href="/documents/front/index/menuItem/1625">1</a></li>
                            <li class="page"><a href="/documents/front/index/menuItem/1625/Documents_page/2">2</a></li>
                            <li class="page"><a href="/documents/front/index/menuItem/1625/Documents_page/3">3</a></li>
                            <li class="next"><a href="/documents/front/index/menuItem/1625/Documents_page/2">Следующая&nbsp;&nbsp;→</a></li>
                            <li class="last"><a href="/documents/front/index/menuItem/1625/Documents_page/3"></a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

