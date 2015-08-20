<?php
/* @var $this AdminController */
/* @var $model Smi */

$this->breadcrumbs = array(
    'Публикации СМИ' => '/smi/back/index',
    'Создание записи',
);
?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>