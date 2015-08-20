<?php
/* @var $this AdminController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => '/news/back/index',
    'Создание новости',
);
?>
<?php echo $this->renderPartial('_form', array('model' => $model)); ?>