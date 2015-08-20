<?php
/**
 * @var $this Controller
 * @var $record Opendata
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Открытые данные';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Открытые данные' => $this->createUrl('/opendata/front'),
    $record->title,
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
                <p>
                    <div>
                        <b>Орган власти:</b>
                        <?php if ($portal) : ?>
                            <?php echo CHtml::link($portal->title, 'http://' . $portal->alias); ?>
                        <?php endif; ?>
                    </div>
                    <div>
                        <b>Ответственное лицо:</b>
                        <?php echo $record->responsible; ?>
                    </div>
                    <div>
                        <b>Телефон ответственного лица:</b>
                        <?php echo $record->phone; ?>
                    </div>
                    <div>
                        <b>Адрес электронной почты ответственного лица:</b>
                        <?php echo $record->email; ?>
                    </div>
                </p>
                <p>
                    <?php echo $record->description; ?>
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
                                <?php echo CHtml::link("Таблица RDF'а", $this->createUrl('/opendata/front/getTable', array('id' => $record->id)), array('target' => '_blank')); ?>
                            </div>
                            <div class="item">
                                <?php echo CHtml::link('XML', $this->createUrl('/opendata/front/getXML', array('id' => $record->id)), array('target' => '_blank')); ?>
                            </div>
                            <div class="item">
                                <?php echo CHtml::link('API', $this->createUrl('/opendata/front/getAPI', array('id' => $record->id)), array('target' => '_blank')); ?>
                            </div>
                            <div class="item">
                                <?php echo CHtml::link('Набор данных (CSV)', $this->createUrl('/opendata/front/getVersion', array('id' => $record->id))); ?>
                            </div>
                            <div class="item">
                                <?php echo CHtml::link('СТРУКТУРА (CSV)', File::model()->getFileUrl($record->structure_file)); ?>
                            </div>
                            <div class="item">
                                <?php echo CHtml::link('ПАСПОРТ (CSV)', $this->createUrl('/opendata/front/getPassport', array('id' => $record->id))); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (count($record->versions)) : ?>
                    <div class="item active">
                        <div class="title">
                            <div class="name">Версии</div>
                            <div class="toggle"></div>
                        </div>
                        <div class="desc">
                            <table class="simple-table fixed">
                                <tbody>
                                    <?php foreach ($record->versions as $version) : ?>
                                        <tr>
                                            <td>CSV</td>
                                            <td><?php echo $record->title; ?></td>
                                            <td><?php echo date('d-m-Y H:i', $version->date); ?></td>
                                            <td><?php echo CHtml::link('Скачать', $this->createUrl('/opendata/front/getVersion', array('id' => $record->id, 'version' => $version->id))); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
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
                                    <td>Владелец набора данных</td>
                                    <td><?php echo $record->owner; ?></td>
                                </tr>
                                <tr>
                                    <td>Дата первой публикации набора данных</td>
                                    <td><?php echo date('d-m-Y', $record->date_init); ?></td>
                                </tr>
                                <tr>
                                    <td>Дата последнего внесения изменений</td>
                                    <td><?php echo date('d-m-Y', $record->date_last_change); ?></td>
                                </tr>
                                <tr>
                                    <td>Дата актуальности</td>
                                    <td><?php echo date('d-m-Y', $record->date_actual); ?></td>
                                </tr>
                                <tr>
                                    <td>Содержание последнего изменения</td>
                                    <td><?php echo $record->last_content; ?></td>
                                </tr>
                                <tr>
                                    <td>Идентификационный номер</td>
                                    <td><?php echo $record->identifier; ?></td>
                                </tr>
                                <tr>
                                    <td>Ключевые слова, соответствующие содержанию набора данных</td>
                                    <td><?php echo $record->keyword; ?></td>
                                </tr>
                                <tr>
                                    <td>Формат набора открытых данных</td>
                                    <td>CSV</td>
                                </tr>
                                <tr>
                                    <td>Версия методических рекомендаций</td>
                                    <td><?php echo $record->version; ?></td>
                                </tr>
                                <tr>
                                    <td>Описание структуры набора открытых данных</td>
                                    <td><?php echo CHtml::link($this->createAbsoluteUrl('/') . File::model()->getFileUrl($record->structure_file), File::model()->getFileUrl($record->structure_file)); ?></td>
                                </tr>
                                <tr>
                                    <td>Гиперссылка (URL) на открытые данные</td>
                                    <td><?php echo CHtml::link($this->createAbsoluteUrl('/opendata/front/getVersion', array('id' => $record->id)), $this->createUrl('/opendata/front/getVersion', array('id' => $record->id))); ?></td>
                                </tr>
                                <tr>
                                    <td>Гиперссылки (URL) на версии открытых данных</td>
                                    <td>
                                        <?php foreach ($record->versions as $version) : ?>
                                            <?php echo CHtml::link($this->createAbsoluteUrl('/opendata/front/getVersion', array('id' => $record->id, 'version' => $version->id)), $this->createUrl('/opendata/front/getVersion', array('id' => $record->id, 'version' => $version->id))) . '<br/>'; ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Гиперссылки (URL) на версии структуры набора данных</td>
                                    <td>
                                        <?php foreach ($record->versions as $version) : ?>
                                            <?php echo CHtml::link($this->createAbsoluteUrl('/opendata/front/getStructure', array('id' => $record->id, 'version' => $version->id)), $this->createUrl('/opendata/front/getStructure', array('id' => $record->id, 'version' => $version->id))) . '<br/>'; ?>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    b {
        font-weight: bold;
    }
</style>