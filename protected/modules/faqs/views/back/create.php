<?php
/* @var $this AdminController */
/* @var $model Faqs */

$this->breadcrumbs = array(
    'Часто задаваемые вопросы' => '/faqs/back/index',
    'Создание вопроса',
);
?>

<div class="page-header">
    <h2>Создание вопроса</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>