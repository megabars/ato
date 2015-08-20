<?php
/* @var $this AdminController */
/* @var $model Smi */

$this->pageTitle = $this->portalId == 1 ? 'Томская область в СМИ' : 'Публикации СМИ';

$this->breadcrumbs = array(
    $this->pageTitle => '/smi/back/index',
    $model->title,
);
?>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>