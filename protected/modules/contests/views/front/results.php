<?php
/**
 * @var $this Controller
 * @var $records News[]
 */
$app = Yii::app();
$assets = $this->assetsBase;
$this->pageTitle = 'Итоги конкурсов';

$this->breadcrumbs = array(
    'Открытый регион' => $this->createUrl('/Otkritiy-region'),
    'Конкурсы' => $this->createUrl('contests/front'),
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Итоги конкурсов</h2>
    <div class="clearfix">

        <div class="right-content">
            <div class="right-menu">
                <a href="/contests/front/index">Открытые конкурсы</a>
                <a href="/contests/front/results" class="active">Итоги конкурсов</a>
                <a href="/contests/front/archive">Архив конкурсов</a>
            </div>
        </div>

        <div class="left-content">

            <div class="select-filter">
                Показать итоги конкурсов за
                <select class="select">
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
                        'name' => 'Предмет конкурса',
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

        $('.selecter-item').on('click', function(e) {
            window.location.href = "/contests/front/results/?month=" + this.getAttribute('data-value');
        });
    });
</script>

