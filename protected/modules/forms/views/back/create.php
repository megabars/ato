<?php
/* @var $this AdminController */
/* @var $model Forms */

$this->breadcrumbs = array(
    'Формы обращений и заявлений' => '/forms/back/index',
    'Создание записи',
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>