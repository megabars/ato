<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Архив конкурсов';

$this->breadcrumbs = array(
    'Открытый регион' => $this->createUrl('/Otkritiy-region'),
    'Конкурсы' => $this->createUrl('contests/front'),
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Архив конкурсов</h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="/contests/front/index">Открытые конкурсы</a>
                <a href="/contests/front/results">Итоги конкурсов</a>
                <a href="/contests/front/archive" class="active">Архив конкурсов</a>
            </div>
        </div>

        <div class="left-content">

            <div class="select-filter">
                Показать архив за
                <div style="display: inline-block" id="year-items">
                    <select class="select" id="year">
                        <option value="-1" <?php echo ($year == -1 ? 'selected' : '');?>>Все</option>
                        <option value="2013" <?php echo ($year == 2013 ? 'selected' : '');?>>2013</option>
                        <option value="2014" <?php echo ($year == 2014 ? 'selected' : '');?>>2014</option>
                        <option value="2015" <?php echo ($year == 2015 ? 'selected' : '');?>>2015</option>
                    </select>
                </div>

                <div style="display: inline-block" id="month-items">
                    <select class="select" id="month">
                        <option value="-1" <?php echo ($month == -1 ? 'selected' : '');?>>Все месяцы</option>
                        <option value="1" <?php echo ($month == 1 ? 'selected' : '');?>>Январь</option>
                        <option value="2" <?php echo ($month == 2 ? 'selected' : '');?>>Февраль</option>
                        <option value="3" <?php echo ($month == 3 ? 'selected' : '');?>>Март</option>
                        <option value="4" <?php echo ($month == 4 ? 'selected' : '');?>>Апрель</option>
                        <option value="5" <?php echo ($month == 5 ? 'selected' : '');?>>Май</option>
                        <option value="6" <?php echo ($month == 6 ? 'selected' : '');?>>Июнь</option>
                        <option value="7" <?php echo ($month == 7 ? 'selected' : '');?>>Июль</option>
                        <option value="8" <?php echo ($month == 8 ? 'selected' : '');?>>Август</option>
                        <option value="9" <?php echo ($month == 9 ? 'selected' : '');?>>Сентябрь</option>
                        <option value="10" <?php echo ($month == 10 ? 'selected' : '');?>>Октябрь</option>
                        <option value="11" <?php echo ($month == 11 ? 'selected' : '');?>>Ноябрь</option>
                        <option value="12" <?php echo ($month == 12 ? 'selected' : '');?>>Декабрь</option>
                    </select>
                </div>
            </div>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'contests',
                'dataProvider'=>$records->search(),
                'cssFile' => false,
                'itemsCssClass' => 'table',
                'template' => '{items}{pager}',
                'columns'=>array(
                    'org',
                    array(
                        'name' => 'Название конкурса',
                        'value' => '$data->getTitleWithLink()',
                        'type' => 'html',
                    ),
                    array(
                        'header' => 'Предмет конкурса',
                        'value' => '$data->description_small',
                    ),
                    array(
                        'name' => 'Дата завершения',
                        'value' => 'date("d.m.y", $data->date_end)',
                    ),
                    array(
                        'name' => 'Результаты',
                        'value' => '$data->getFileLink()',
                        'type' => 'html',
                    )

                ),
                'pager'=>array(
                    'header'=>'',
                    'cssFile'=>false,
                    'firstPageLabel'=> false,
                    'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
                    'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
                    'lastPageLabel'=> false,
                ),
            )); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#year-items .selecter .selecter-options .selecter-item').on('click', function(e) {
            var year = this.getAttribute('data-value');
            var month = $('.selected:last').attr('data-value') || -1;
            window.location.href = "/contests/front/archive/?year=" + year + '&month=' + month;
        });
        $('#month-items .selecter .selecter-options .selecter-item').on('click', function(e) {
            var year = $('.selected:first').attr('data-value');
            var month = this.getAttribute('data-value');
            window.location.href = "/contests/front/archive/?year=" + year + '&month=' + month;
        });

    });
</script>


