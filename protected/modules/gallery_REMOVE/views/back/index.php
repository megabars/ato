<?php
/** @var $this AdminController */
/** @var $model Gallery */

$this->breadcrumbs = array(
    'Галереи',
);
?>

<div class="page-header">
    <h2>Галереи</h2>
</div>

    <div class="list-group-wrapper">
        <div class="list-group">
            <?php foreach (GalleryType::instance()->list as $key => $item) : ?>
                <a class="list-group-item <?php echo ($type == $key) ? 'active' : ''; ?>"
                   href="<?php echo $this->createUrl('/gallery/back/index', array('type' => $key)); ?>">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

<div style="width: 79%; float:right;">
    <div class="list-group">
        <a class="btn btn-default btn-sm icons remove-all" href="<?php echo $this->createUrl('/gallery/back/deleteAll'); ?>">
            Удаление
        </a>
        <a class="btn btn-sm icons white add-new fr" href="<?php echo $this->createUrl('/gallery/back/create'); ?>">
            Создать галерею
        </a>
    </div>

<?php
$this->widget('application.widgets.adminGridView', array(
    'dataProvider' => $model->search(),
    'filter' => $model,
    'enablePagination' => true,
    'enableSorting' => true,
    'summaryText' => '',
    'template' => "{summary}{items}{pager}",
    'columns' => array(
        array(
            'class' => 'StyledCheckBoxColumn',
            'selectableRows' => 2,
            'checkBoxHtmlOptions' => array('class' => 'checkbox-id', 'name' => 'ids[]'),
        ),
        array(
            'name' => 'title',
            'sortable' => true,
        ),
        array(
            'name' => 'date',
            'value' => 'date("d-m-Y H:i", $data->date)',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'name' => 'state',
            'value' => '$data->state ? "Да" : "Нет"',
            'sortable' => true,
            'filter' => false,
        ),
        array(
            'header' => 'Действия',
            'class' => 'CButtonColumn',
            'template' => '{update}{delete}',
        ),
    ),
)); ?>
</div>

