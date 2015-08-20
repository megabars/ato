<?php
/* @var $this AdminController */
/* @var $model Video */

$this->breadcrumbs = array(
    'Видеогалерея' => '/video/back/index',
    'Создание видео',
);
?>

<div class="page-header">
    <h2>Создание видео</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>