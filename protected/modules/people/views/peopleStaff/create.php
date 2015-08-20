<?php
$this->breadcrumbs['Сотрудники'] = '/people/peopleStaff/index/people_id/'.@$this->people->id;
$this->breadcrumbs[] = 'Создание';
?>

<div class="page-header">
    <h2>Создание</h2>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model));