<?php
/* @var $this AdminController */
/* @var $model Staff */

$this->breadcrumbs = array(
    'Горячие линии' => '/feedback/hotlines/index',
    'Редактирование записи',
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>