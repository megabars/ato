<?php
$this->breadcrumbs[] ='Редактирование';
?>
<div class="page-header">
    <h2>Редактирование</h2>
</div>
<?php
echo $this->renderPartial('/back/_form', array('model' => $model));