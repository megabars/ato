<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Госзакупки';

$this->breadcrumbs = array(
    'Госзакупки'
);

?>

<div class="wrap">
    <h2>Госзакупки</h2>

    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <?php $this->widget('navigation.widgets.menuByAlias', array(
                    'parentId' => $this->navigationItemId,
                    'menu_alias' => 'main_menu',
                    'max_levels' => 0
                )); ?>
            </div>
        </div>

        <div class="left-content">
            <div class="custom-content">
                <p>
                    Стратегическое планирование на региональном уровне представляет собой систему документов стратегического и программно-целевого планирования Томской области.
                </p>
                <p>
                    Порядок осуществления процедуры разработки, рассмотрения и утверждения документов стратегического и программно-целевого планирования Томской области, контроля за их реализацией, а также полномочия органов государственной власти Томской области при формировании и утверждении документов стратегического и программно-целевого планирования Томской области указаны в Законе Томской области от 14.09.2009 N 177-ОЗ "О системе документов стратегического и программно-целевого планирования Томской области".
                </p>
            </div>

            <div class="list-links mt30">
                <ul>
                    <li><a target="_blank" href="http://zakaz.tomsk.gov.ru/purchaseOfrRegister.do">Закупки на этапе подачи заявок</a></li>
                    <li><a target="_blank" href="http://monitoring.tomsk.gov.ru/index.php/razdely/monitoring-zakupok">Мониторинг закупок</a></li>
                    <li><a target="_blank" href="http://zakupki.gov.ru/epz/order/extendedsearch/search.html?placeOfSearch=FZ_44&placeOfSearch=FZ_223&orderPriceFrom=&orderPriceTo=&orderPriceCurrencyId=-1&deliveryAddress=&participantName=&orderPublishDateFrom=&orderPublishDateTo=&orderUpdateDateFrom=&orderUpdateDateTo=&customer.title=&customer.code=&customer.fz94id=&customer.fz223id=&customer.Inn=&custLev=S&agency.title=&agency.code=&agency.fz94id=&agency.fz223id=&agency.Inn=&regionIds=5277393&orderStages=AF&orderStages=CA&orderStages=PC&orderStages=PA&searchTextInAttachedFile=&applSubmissionCloseDateFrom=&applSubmissionCloseDateTo=&searchString=&morphology=false&strictEqual=false">Реестр закупок и заказов</a></li>
                </ul>
            </div>
        </div>
    </div>


</div>