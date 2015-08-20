<?php
/* @var $this AdminController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видеогалерея' => '/video/back/index',
    'Редактирование видео',
);
?>

<div class="page-header">
    <h2>Редактирование видео</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>