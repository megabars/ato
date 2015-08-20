<?php
/** @var $this AdminController */
/** @var $record Feedback */

$this->breadcrumbs = array(
    'Обратная связь',
);
?>

<div class="page-header">
    <h2>Обратная связь</h2>
</div>

Тип вопроса:
<?php echo FeedbackType::instance()->list[$record->type]; ?>
<br/>

ФИО:
<?php echo $record->fio; ?>
<br/>

E-mail:
<?php echo $record->email; ?>
<br/>

Текст вопроса:
<?php echo $record->text; ?>