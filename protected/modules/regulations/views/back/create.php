<?php

/**
 * @var $this AdminController
 * @var $model Discuss
 */

$this->breadcrumbs = array(
    'Административные регламенты' => '/regulations/back/index',
    'Создание записи',
);
?>

<div class="page-header">
    <h2>Создание записи</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>