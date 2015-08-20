<?php
/* @var $this AdminController */
/* @var $model CategoryPost */

$this->pageTitle = 'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера';

$this->breadcrumbs = array(
    'Противодействие коррупции' => $this->createUrl('/antiCorruption/back/index'),
    'Сведения о доходах, расходах, об имуществе и обязательствах имущественного характера' => $this->createUrl('/antiCorruption/public/index'),
    'Список категорий' => $this->createUrl('/antiCorruption/category/index'),
    'Редактирование записи'
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>