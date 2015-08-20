<?php
/**
 * @var $this FrontController
 */
$this->pageTitle = 'Сообщить о коррупции';

$this->breadcrumbs = array(
    'Противодействие коррупции',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('_menu'); ?>

        <div class="left-content">
            <?php $this->widget('application.modules.appeal.widgets.FrameAppealWidget', array('antiCorruption'=>true)); ?>
        </div>
    </div>
</div>

