<?php
/**
 * @var $this Controller
 * @var $records Experts
 */
$this->pageTitle = 'База данных экспертов';

$this->breadcrumbs = array(
    'Открытый регион' => array('/Otkritiy-region'),
    $this->pageTitle
);
?>

<div class="wrap">
    <a class="btn fr" href="<?php echo $this->createUrl('/experts/front/register'); ?>">Зарегистрироваться как эксперт</a>
    <h2><?php echo $this->pageTitle; ?></h2>


    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'experts-form',
        'dataProvider'=>$model->search(),
        'cssFile' => false,
        'enableSorting' => false,
        'ajaxUpdate'=>true,
        'itemsCssClass' => 'table',
        'template' => '{items}{pager}',
        'columns'=>array(
            array(
                'name'=>'photo',
                'type' => 'raw',
                'value'=>'(isset($data->photo)) ? CHtml::image($data->getSmallUrl(), $data->fio): ""',
            ),
            array(
                'name'=>'fio',
            ),
            array(
                'name'=>'post',
            ),
            array(
                'name'=>'expert_council_id',
                'type' => 'raw',
                'value'=>'$data->expert_council->title',
                'headerHtmlOptions'=>array('class'=>'last'),
            ),
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