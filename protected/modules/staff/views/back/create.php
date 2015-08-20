<?php
/* @var $this AdminController */
/* @var $model Staff */

$this->breadcrumbs = array(
    'Кадровая политика' => '/staff/back/index',
    'Создание записи',
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>