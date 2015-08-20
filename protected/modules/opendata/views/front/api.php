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
    'API'
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

                <h3>Ссылки на наборы данных в формате:
                    <?php echo CHtml::link('json', $this->createUrl('/opendata/front/data', array('id' => $record->id, 'type' => 'json')), array('target' => '_blank')); ?> |
                    <?php echo CHtml::link('xml', $this->createUrl('/opendata/front/data', array('id' => $record->id, 'type' => 'xml')), array('target' => '_blank')); ?>
                </h3>

                <h3>Возможные входные параметры (filter_params):</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Переменная</th>
                            <th>Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>id</td>
                            <td>Идентификатор набора данных</td>
                        </tr>
                        <tr>
                            <td>fields</td>
                            <td>Выбор только нужных полей через запятую</td>
                        </tr>
                        <tr>
                            <td>sortby</td>
                            <td>Сортировка по полю</td>
                        </tr>
                        <tr>
                            <td>type</td>
                            <td>Тип выдачи данных - xml, json</td>
                        </tr>
                    </tbody>
                </table>

                <h3>Возможные поля данных (fields):</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Название поля</th>
                            <th>Описание</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($names as $item) : ?>
                            <tr>
                                <td><?php echo $item; ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h3>Данные:</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Массив данных</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fileData as $index => $row) : ?>
                            <tr>
                                <td><?php echo ($index + 1); ?></td>
                                <td><pre><?php echo print_r($row, true); ?></pre></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
