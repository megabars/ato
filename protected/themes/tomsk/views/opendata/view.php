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
            <h3>Сведения о получателях финансовой поддержки
                и предоставленной поддержке</h3>

            <div class="custom-content">
                <p>
                    <div><b>Организация:</b> <a href="">Комитет Тульской области по предпринимательству и потребительскому рынку</a></div>
                    <div><b>Категория:</b> <a href="">Предпринимательство и бизнес</a></div>
                </p>
                <p>
                    Сведения содержат: категорию получателя поддержки, наименование юридического лица, размер и вид поддержки, адрес получателя поддержки и географические координаты.
                </p>
            </div>

            <div class="collapses mt30">
                <div class="item active">
                    <div class="title">
                        <div class="name">Данные</div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <div class="files file-col4">
                            <div class="item">
                                <a href="" title="" class="file">ТАБЛИЦА RDF'а</a>
                            </div>
                            <div class="item">
                                <a href="" title="" class="file">RDF/XML</a>
                            </div>
                            <div class="item">
                                <a href="" title="" class="file">API</a>
                            </div>
                            <div class="item">
                                <a href="" title="" class="file">CSV</a>
                            </div>
                            <div class="item">
                                <a href="" title="" class="file">КАРТА</a>
                            </div>
                            <div class="item">
                                <a href="" title="" class="file">СТРУКТУРА (CSV)</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item active">
                    <div class="title">
                        <div class="name">
                            Сведения
                        </div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">

                        <table class="simple-table fixed">
                            <tbody>
                                <tr>
                                    <td>Дата первой публикации набора данных</td>
                                    <td>08.12.2014 17:51:22</td>
                                </tr>
                                <tr>
                                    <td>Дата первой публикации набора данных</td>
                                    <td>08.12.2014 17:51:22</td>
                                </tr>
                                <tr>
                                    <td>Содержание последнего изменения</td>
                                    <td>null</td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова, соответствующие содержанию набора данных</td>
                                    <td>получатели поддержки, финансовая поддержка, предпринимательство, вид поддержки</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

