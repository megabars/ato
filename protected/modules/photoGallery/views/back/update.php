<?php
/* @var $model PhotoGallery */
/* @var $this AdminController */

$this->breadcrumbs = array(
    'Фотогалерея' => '/photoGallery/back/index',
    'Редактирование фотогалереи',
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>