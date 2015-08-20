<?php
/**
 * @var $this Controller
 * @var $record Opendata
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые данные';

$this->breadcrumbs = array(
    'Открытые данные' => $this->createUrl('/opendata/front'),
    $record->title => $this->createUrl('/opendata/front/view', array('id' => $record->id)),
    'Таблица'
);
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
            <h3><?php echo $record->title; ?></h3>

            <div class="custom-content">
                <table class="table bigTable">
                    <thead>
                        <tr>
                            <?php foreach ($names as $item) : ?>
                                <th><?php echo $item; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fileData as $row) : ?>
                            <tr>
                                <?php foreach ($row as $column) : ?>
                                    <td><?php echo $column; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
