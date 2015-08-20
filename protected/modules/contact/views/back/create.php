<?php
/* @var $this AdminController */
/* @var $model Contact */

$this->breadcrumbs = array(
    'Контактная информация' => '/contact/back/index',
    'Добавление контактных данных',
);
?>

<h1>Добавление контактных данных</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>