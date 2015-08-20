<?php

/**
 * @var $this AdminController
 * @var $model Discuss
 */

$this->breadcrumbs = array(
    'Общественные обсуждения НПА' => '/discuss/back/index',
    'Редактирование записи',
);
?>

<div class="page-header">
    <h2>Редактирование записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>