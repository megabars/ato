<?php
/**
 * @var $this FrontController
 * @var $model AcFile
 */

$this->breadcrumbs = array(
    'Противодействие коррупции',
    $this->pageTitle
);
?>

<div class="wrap invalid-version">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('_menu'); ?>

        <?php $this->renderPartial('_file_list', array('model'=>$model)); ?>
    </div>
</div>