<?php
/* @var $this AdminController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => '/news/back/index',
    'Категории новости' => '/news/type/index',
    'Создание категории новости',
);
?>

<h1>Создание категории новости</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>