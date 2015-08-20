<?php
/* @var $this AdminController */
/* @var $model Page */

$title = ($model->isNewRecord) ? 'Создание страницы' : 'Изменение страницы';

$this->breadcrumbs = array(
    'Страницы' => $this->createUrl('/pages/back', array('type' => $model->type_id)),
    $title,
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>