<?php
/* @var $this AdminController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Галереи' => '/gallery/back/index',
    'Создание галереи',
);
?>

<div class="page-header">
    <h2>Создание галереи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>