<?php
/* @var $this AfishaController */
/* @var $model Afisha */

$this->breadcrumbs = array(
    'Календарь мероприятий' => '/afisha/back/index',
    'Создание мероприятия',
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>