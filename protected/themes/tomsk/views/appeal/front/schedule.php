<?php
/**
 * @var $this Controller
 */
$this->pageTitle = 'График приема граждан';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Обращения',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Обращения граждан</h2>
    <h3><?php echo $this->pageTitle; ?></h3>

    <div class="clearfix">
        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">
            <?php $this->widget('application.widgets.adminGridView', array(
                'dataProvider' => $data,
                'enablePagination' => true,
                'template' => "{items}{pager}",
                'itemsCssClass' => 'table',
                'columns' => array(
                    array(
                        'header' => '№',
                        'value' => '$row+1',
                    ),
                    array(
                        'header' => 'Должность',
                        'value' => '@$data->people->job',
                    ),
                    array(
                        'header' => 'Фамилия Имя Отчество',
                        'value' => '@$data->people->full_name',
                    ),
                    array(
                        'name' => 'date',
                        'value' => 'date("d.m.Y", strtotime($data->date))',
                        'sortable' => true,
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>