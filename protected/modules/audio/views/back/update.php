<?php
/* @var $this AdminController */
/* @var $model Audio */

$this->breadcrumbs = array(
    'Аудиоархив' => $this->createUrl('/audio/back/index'),
    'Редактирование записи',
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>