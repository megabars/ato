<?php
/* @var $this AdminController */
/* @var $model Systems */

$this->breadcrumbs = array(
    'Информационные системы, банки данных, реестры, регистры' => '/systems/back/index',
    'Создание записи',
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>