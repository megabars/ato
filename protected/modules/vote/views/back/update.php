<?php
/** @var $this VoteController */
/** @var $record Vote */

$this->breadcrumbs = array(
    'Опросы' => array('index'),
    'Редактирование опроса',
);
?>

<h1>Редактирование опроса</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>