<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые данные';

//$this->breadcrumbs = array(
//    'Открытые данные'
//);
?>

<div class="wrap opendata">
    <h2>Открытые данные</h2>
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
            <h3>Статистика</h3>

            <div class="custom-content min-space mt10">
                <p><b>Органы власти, предоставившие открытые данные:</b> <?php echo Opendata::getOrganizationCount(); ?></p>
                <p><b>Количество наборов данных:</b> <?php echo Opendata::model()->count(); ?></p>
            </div>

            <div class="collapses mt30">
                <div class="item active">
                    <div class="title">
                        <div class="name">Статистика по органам власти</div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <table class="simple-table">
                            <thead>
                                <tr>
                                    <th>Орган власти</th>
                                    <th>Кол-во наборов</th>
                                    <th>Заполненность паспортов</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (Portal::model()->hasOpendata()->findAll() as $portal) : ?>
                                    <tr>
                                        <td><?php echo $portal->title; ?></td>
                                        <td><?php echo Opendata::getCountByOrganizationId($portal->id); ?></td>
                                        <td><?php echo Opendata::getPortalPassportPercent($portal->id); ?> %</td>
                                    </tr>
                                <?php endforeach; ?>
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
                                <?php foreach (Opendata::model()->findAll() as $index => $opendata) : ?>
                                    <tr>
                                        <td><?php echo ($index + 1); ?></td>
                                        <td><?php echo $opendata->title; ?></td>
                                        <td><?php echo $opendata->view_count; ?></td>
                                        <td><?php echo $opendata->download_count; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

