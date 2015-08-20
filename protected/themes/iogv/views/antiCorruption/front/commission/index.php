<?php
/**
 * @var $this FrontController
 * @var $commission AcCommission
 * @var $model AcMembers
 */
$this->pageTitle = 'Состав комиссии';

$this->breadcrumbs = array(
    'Противодействие коррупции',
    'Комиссия Администрации Томской области по соблюдению требований к служебному поведению'=>'/antiCorruption/front/commission',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('commission/_menu'); ?>

        <div class="left-content">
            <?php if(isset($commission->decree)): ?>
            <div class="collapses">
                <div class="item active">
                    <div class="title">
                        <div class="name">
                            Указ Губернатора Томской области о Комиссии по соблюдению требований к служебному
                            поведению государственных гражданских служащих Томской области и урегулированию
                            конфликта интересов
                        </div>
                        <div class="toggle"></div>
                    </div>
                    <div class="desc">
                        <div class="custom-content">
                            <?php echo $commission->decree; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                'dataProvider'=>$model->search(),
                'cssFile' => false,
                'ajaxUpdate'=>true,
                'enableSorting' => false,
                'itemsCssClass' => 'table mt30',
                'template' => '{items}{pager}',
                'columns'=>array(
                    'fio',
                    'post',
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

