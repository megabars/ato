<?php
/* @var $this AdminController */
/* @var $model OpendataVersion */

$this->breadcrumbs = array(
    'Открытые данные' => '/opendata/back/index',
    'Создание версии',
);
?>

<div class="page-header">
    <h2>Создание версии</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>