<?php
/* @var $this AdminController */
/* @var $model Staff */

$this->breadcrumbs = array(
    'Кадровая политика' => $this->createUrl('/staff/back/index'),
    'Список статусов' => $this->createUrl('/staff/state/index'),
    'Создание записи'
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>