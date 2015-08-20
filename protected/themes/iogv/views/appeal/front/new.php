<?php
/**
 * @var $this Controller
 */
$this->pageTitle = 'Подать обращение';

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
            <?php $this->widget('application.modules.appeal.widgets.FrameAppealWidget'); ?>
        </div>
    </div>
</div>
