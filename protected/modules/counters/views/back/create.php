<?php
/* @var $this AdminController */
/* @var $model Counters */

$this->breadcrumbs = array(
    'Счетчики' => '/counters/back/index',
    'Создание счетчика',
);
?>

<div class="page-header">
    <h2>Создание счетчика</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>