<?php
/** @var $model Staff */
?>

<li>
    <div class="label">Наименование должности</div>
    <div class="desc"><?php echo $model->title; ?></div>
</li>
<li>
    <div class="label">Вид конкурса</div>
    <div class="desc"><?php echo @ContestType::instance()->list[$model->contest_type]; ?></div>
</li>
<li>
    <div class="label">Дата размещения</div>
    <div class="desc"><?php echo date('d-m-Y H:i', $model->date); ?></div>
</li>
<li>
    <div class="label">Срок подачи документов</div>
    <div class="desc"><?php echo date('d-m-Y H:i', $model->date_actual); ?></div>
</li>
<li>
    <div class="label">Наименование органа власти</div>
    <div class="desc"><?php echo $model->organization ? $model->organization : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Группа должностей</div>
    <div class="desc"><?php echo $model->group ? $model->group : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Категория должностей</div>
    <div class="desc"><?php echo $model->category ? $model->category : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Обязанности</div>
    <div class="desc"><?php echo $model->responsibility ? $model->responsibility : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Уровень образования</div>
    <div class="desc"><?php echo $model->education_level ? $model->education_level : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Направление образования</div>
    <div class="desc"><?php echo $model->education_direction ? $model->education_direction : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Требования к стажу опыт работы</div>
    <div class="desc"><?php echo implode('<br/>', explode(', ', $model->expirience)); ?></div>
</li>
<li>
    <div class="label">Требования к знаниям</div>
    <div class="desc"><?php echo $model->knowledge ? $model->knowledge : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Навыки</div>
    <div class="desc"><?php echo $model->skill ? $model->skill : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Заработная плата,руб.</div>
    <div class="desc"><?php echo $model->amount_min; ?>-<?php echo $model->amount_max; ?></div>
</li>
<li>
    <div class="label">Контракт</div>
    <div class="desc"><?php echo $model->contract ? $model->contract : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Дополнительная информация</div>
    <div class="desc"><?php echo $model->additional ? $model->additional : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Нормативно-правовые акты</div>
    <div class="desc"><?php echo $model->acts ? $model->acts : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Документы представляемые в конкурсную комиссию:</div>
    <div class="desc"><?php echo $model->documents ? $model->documents : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Контактная информация</div>
    <div class="desc"><?php echo $model->contact ? $model->contact : 'Нет информации'; ?></div>
</li>
<li>
    <div class="label">Информация об итогах конкурса</div>
    <div class="desc"><?php echo @StaffState::model()->findByPk($model->state)->title; ?></div>
</li>

<?php $this->renderPartial('_result', array('model' => $model)); ?>