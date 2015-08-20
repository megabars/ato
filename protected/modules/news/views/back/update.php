<?php
/* @var $this AdminController */
/* @var $model News */

$this->breadcrumbs = array(
    'Новости' => '/news/back/index',
    'Редактирование новости',
);
?>

<h1>Редактирование новости</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>