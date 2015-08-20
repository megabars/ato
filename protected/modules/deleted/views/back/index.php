<?php
/** @var $panels array() */
/** @var $this BackController */

$this->breadcrumbs = array(
    'Корзина',
);
?>

<div class="page-header">
    <h2>Корзина</h2>
</div>

<?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels' => $panels,
    'headerTemplate' => "<h4>{title}</h4>",
    'options' => array(
        'heightStyle' => "content",
    ),
    'htmlOptions' => array(
        'class' => 'accordion'
    )
));