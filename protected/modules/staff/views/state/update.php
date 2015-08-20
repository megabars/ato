<?php
/* @var $this AdminController */
/* @var $model Staff */

$this->breadcrumbs = array(
    'Кадровая политика' => $this->createUrl('/staff/back/index'),
    'Список статусов' => $this->createUrl('/staff/state/index'),
    'Редактирование записи'
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>