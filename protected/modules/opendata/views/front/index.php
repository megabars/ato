<?php
/**
 * @var $this Controller
 * @var $records Opendata[]
 */

$this->pageTitle = 'Открытые данные';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Открытые данные',
);
?>


<div class="wrap opendata invalid-opendata">
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
            <div class="left">
                <div class="checked-list">
                    <div class="collapsed">
                        <a class="check-all-category <?php echo $category ? '' : 'all'; ?>" style="float: right;" href="#"><?php echo $category ? 'Снять все' : 'Выделить все'; ?></a>
                        <div class="title">Категории</div>
                        <div class="body">
                            <ul id="checked-sort">
                                <?php foreach (OpendataCategory::model()->findAll(array('order' => 'title ASC')) as $item) : ?>
                                    <li>
                                        <label>
                                            <?php echo CHtml::checkBox('category', ($category == 'all' || (is_array($category) && in_array($item->id, $category))) ? true : false, array('class' => 'styled category-checkbox', 'data-id' => $item->id)); ?>
                                            <span class="label"><?php echo $item->title; ?></span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="collapsed">
                        <a class="check-all-iogv <?php echo $portal_id ? '' : 'all'; ?>" style="float: right;" href="#"><?php echo $portal_id ? 'Снять все' : 'Выделить все'; ?></a>
                        <div class="title" class="check-all-category" href="#">Орган власти</div>
                        <div class="body" style="display: none;">
                            <ul id="checked-sort">
                                <?php foreach ($portals as $item) : ?>
                                    <li>
                                        <label>
                                            <?php echo CHtml::checkBox('portal', ($portal_id == 'all' || (is_array($portal_id) && in_array($item->id, $portal_id))) ? true : false, array('class' => 'styled portal-checkbox', 'data-id' => $item->id)); ?>
                                            <span class="label"><?php echo $item->title; ?></span>
                                        </label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right">

                <div class="search-left-content">
                    <div class="info">
                        <div class="download">Скачать реестр: <?php echo CHtml::link('csv', $this->createUrl('/opendata/front/getAllOpendata')); ?></div>
                        <div class="count"><?php echo $all_item_count . ' ' . PluralEndings::getEnding($all_item_count, 'набор данных', 'набора данных', 'наборов данных'); ?></div>
                    </div>

                    <?php $form = $this->beginWidget('CActiveForm', array(
                        'action' => $this->createUrl('/opendata/front/index'),
                        'id' => 'search-form',
                        'method' => 'get',
                    )); ?>

                        <button type="submit" class="btn-default">Искать</button>

                        <div class="input">
                            <?php echo CHtml::textField('title', $title, array('maxlength' => 255)); ?>
                        </div>

                        <?php echo CHtml::hiddenField('category', is_array($category) ? implode(',', $category) : $category, array('class' => 'opendata-category')); ?>
                        <?php echo CHtml::hiddenField('portal_id', is_array($portal_id) ? implode(',', $portal_id) : $portal_id, array('class' => 'opendata-portal')); ?>
                    <?php $this->endWidget(); ?>
                </div>

                <div class="result">
                    <div>Результат поиска</div>
                    найдено: <?php echo $count . ' ' . PluralEndings::getEnding($count, 'набор данных', 'набора данных', 'наборов данных'); ?>
                </div>

                <div class="data-list">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>№</td>
                                <td>Название</td>
                                <td>Категория</td>
                                <td>Орган власти</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $index => $record) : ?>
                                <tr>
                                    <td><?php echo ($pages->pageSize * $pages->currentPage) + ($index + 1); ?></td>
                                    <td><?php echo CHtml::link($record->title, $this->createUrl('/opendata/front/view', array('id' => $record->id))); ?></td>
                                    <td>
                                        <?php
                                        $categories = array();
                                        foreach ($record->category_list as $item)
                                        {
                                            if ($category = OpendataCategory::model()->findByPk($item->category_id))
                                                $categories[] = $category->title;
                                        }
                                        ?>
                                        <?php echo implode(',', $categories); ?>
                                    </td>
                                    <td><?php echo $record->owner; ?></td>
                                    <td><?php echo CHtml::link('csv', $this->createUrl('/opendata/front/getVersion', array('id' => $record->id))); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php $this->widget('application.widgets.customPager', array('pages' => $pages)); ?>
                </div>
            </div>
        </div>
    </div>
</div>