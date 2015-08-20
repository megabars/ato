<?php
/**
 * @var $this Controller
 * @var $model Staff
 */

$this->pageTitle = 'Кадровая политика';

$this->breadcrumbs = array(
    'Кадровая Политика' => $this->createUrl('/kadr-politic'),
    'Государственная гражданская служба' => $this->createUrl('/Gosudarstvennaya-grazhdanskaya-sluzhba-'),
    'Конкурсы на замещение вакантных должностей и включение в кадровый резерв' => $this->createUrl('/staff/front/index'),
    $title
);
?>

<div class="wrap">
    <h2>Конкурсы на замещение вакантных должностей и включение в кадровый резерв</h2>

    <div class="clearfix">
        <div class="right-content">
            <div class="right-menu">
                <ul>
                    <li>
                        <a class="<?php echo ($state == 2) ? 'active' : ''; ?>"
                           href="<?php echo $this->createUrl('/staff/front/index', array('state' => 2)); ?>">
                            Итоги конкурсов
                        </a>
                    </li>
                    <li>
                        <a class="<?php echo ($state == -1) ? 'active' : ''; ?>"
                           href="<?php echo $this->createUrl('/staff/front/index', array('state' => -1)); ?>">
                            Архив конкурсов
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="left-content">
            <h3>Вакансии</h3>

            <div class="grid-search">
                <?php $this->renderPartial('_search', array('model' => $model, 'portals' => $portals, 'directions' => $directions, 'orgs' => $orgs)); ?>
            </div>

            <h4>
                Результат поиска
                <div class="filter-day">
                    за последние:
                    <a href="#" onclick="$('.search_date').val(3);$('#search-form2').submit();return false;">3 дня</a>
                    <a href="#" onclick="$('.search_date').val(7);$('#search-form2').submit();return false;">За неделю</a>
                    <a href="#" onclick="$('.search_date').val(30);$('#search-form2').submit();return false;">За месяц</a>
                </div>
            </h4>

            <?php
            $columns = array(
                array(
                    'header' => 'Должность',
                    'name' => 'title',
                    'type' => 'raw',
                    'value' => 'CHtml::link($data->title,array("/staff/front/view/id/".$data->id));',
                ),
                array(
                    'header' => 'Дата',
                    'name' => 'date',
                    'type' => 'raw',
                    'value' => 'date("d-m-Y", $data->date)',
                ),
                array(
                    'header' => 'Зарплата',
                    'name' => 'amount_max',
                    'type' => 'raw',
                    'value' => '$data->amount_min . " - " . $data->amount_max',
                ),
                array(
                    'header' => 'Статус',
                    'name' => 'state',
                    'type' => 'raw',
                    'value' => '@StaffState::model()->findByPk($data->state)->title',
                ),
            );

            if ($state == 2 || $state == -1)
            {
                $columns[] = array(
                    'header' => 'Результаты',
                    'name' => 'result_file',
                    'type' => 'raw',
                    'value' => '$data->result . "<div>" . ($data->result_file ? CHtml::link("Скачать", File::model()->getFileUrl($data->result_file)) : "") . "</div>"',
                );
            }

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'docs-form',
                'dataProvider' => $model->search(),
                'cssFile' => FALSE,
                'ajaxUpdate' => TRUE,
                'itemsCssClass' => 'table jobs',
                'template' => '{items}{pager}',
                'columns' => $columns,
                'pager' => array(
                    'header' => '',
                    'cssFile' => FALSE,
                    'firstPageLabel' => FALSE,
                    'prevPageLabel' => '&larr;&nbsp;&nbsp;Предыдущая',
                    'nextPageLabel' => 'Следующая&nbsp;&nbsp;&rarr;',
                    'lastPageLabel' => FALSE,
                ),
            )); ?>
        </div>
    </div>
</div>
