<?php
/** @var $this VoteController */
/** @var $record Vote */

$this->breadcrumbs = array(
    'Опросы' => array('index'),
    'Создание опроса',
);
?>

<h1>Создание опроса</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>