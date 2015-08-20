<?php
/* @var $this AdminController */
/* @var $model PublicReport */

$this->breadcrumbs = array(
    'Формы публичной отчетности' => $this->createUrl('/publicReport/back/index'),
    'Редактирование форм',
);
?>

    <div class="page-header">
        <h2>Редактирование форм</h2>
    </div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>