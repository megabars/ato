<?php
/* @var $this AdminController */
/* @var $model Forms */

$this->breadcrumbs = array(
    'Формы обращений и заявлений' => '/forms/back/index',
    'Редактирование записи',
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>