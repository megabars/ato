<?php
/* @var $this AdminController */
/* @var $model PublicReport */

$this->breadcrumbs = array(
    'Формы публичной отчетности' => $this->createUrl('/publicReport/back/index'),
    'Добавление форм',
);
?>

    <div class="page-header">
        <h2>Добавление форм</h2>
    </div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>