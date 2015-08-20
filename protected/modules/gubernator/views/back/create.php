<?php
/* @var $this AdminController */
/* @var $model News */

$this->breadcrumbs = array(
    'Губернатор' => '/gubernator/back/index',
    'Создание фразы',
);
?>

<h1>Создание фразы</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>