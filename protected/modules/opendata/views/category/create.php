<?php
/* @var $this AdminController */
/* @var $model Opendata */

$this->breadcrumbs = array(
    'Открытые данные' => '/opendata/back/index',
    'Список категорий' => $this->createUrl('/opendata/category'),
    'Создание записи',
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>