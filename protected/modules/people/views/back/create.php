<?php
$this->breadcrumbs[] ='Создание';
?>
<div class="page-header">
    <h2>Создание</h2>
</div>
<?php echo $this->renderPartial('/back/_form', array('model' => $model));