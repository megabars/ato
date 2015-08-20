<?php
/**
 * @var $this Controller
 * @var $model Staff
 */

$this->pageTitle = 'Кадровая политика';

$this->breadcrumbs = array(
    'Кадровая Политика' => $this->createUrl('/kadr-politic'),
    'Государственная гражданская служба' => $this->createUrl('/Gosudarstvennaya-grazhdanskaya-sluzhba-'),
    'Кадровые резервы Томской области'
);
?>

<div class="wrap">
    <h2><?php echo $model->title; ?></h2>

    <div class="clearfix">
<!--        <div class="right-content">-->
<!--            <div class="right-menu">-->
<!--                --><?php //$this->widget('navigation.widgets.menuByAlias', array(
//                    'parentId' => $this->navigationItemId,
//                    'menu_alias' => 'main_menu',
//                    'max_levels' => 0
//                )); ?>
<!--            </div>-->
<!--        </div>-->

        <div class="left-content">

            <ul class="jobs-list">
                <?php $this->renderPartial('_type_'. $model->type, array('model' => $model)); ?>
            </ul>
        </div>
    </div>
</div>
