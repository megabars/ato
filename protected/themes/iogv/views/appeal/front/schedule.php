<?php
/**
 * @var $this Controller
 */
$this->pageTitle = 'График приема граждан';

$this->breadcrumbs = array(
    'Обращения граждан',
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
                'enableSorting' => false,
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
                        'name' => 'week_days',
                        'value' => '$data->getWeekDays()',
                    ),
                    array(
                        'header' => 'Время приема',
                        'value' => function($data) {
                            $time = date("H:i", strtotime($data->time_start));
                            if(isset($data->time_end))
                                $time .= ' - '.date("H:i", strtotime($data->time_end));
                            return $time;
                        },
                    ),
                ),
            )); ?>
        </div>
    </div>
</div>