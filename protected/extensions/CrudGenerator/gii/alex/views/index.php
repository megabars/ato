<?php
/**
 * @var CModel $model
 * @var CCodeForm $form
 */

$class = get_class($model);
Yii::app()->clientScript->registerScript('gii.crud',
	"$('#{$class}_controller').change(function(){
        $(this).data('changed', $(this).val()!='');
    });
    $('#{$class}_model').bind('keyup change', function(){
        var controller = $('#{$class}_controller');
        if(!controller.data('changed')) {
            var id = new String($(this).val().match(/\\w*$/));
            if(id.length > 0)
                id = id.substring(0,1).toLowerCase() + id.substring(1);
            controller.val('admin/' + id);
        }
    });"
);
?>

<h1>Alex Generator</h1>

<?php $form = $this->beginWidget('CCodeForm', array('model' => $model)); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'model'); ?>
        <?php echo $form->textField($model, 'model', array('size' => 65)); ?>
        <div class="tooltip">
            Класс модели регистрозависимый!
        </div>
        <?php echo $form->error($model, 'model'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'controller'); ?>
        <?php echo $form->textField($model, 'controller', array('size' => 65)); ?>
        <div class="tooltip">
            Класс контроллера регистрозависимый!
        </div>
        <?php echo $form->error($model, 'controller'); ?>
    </div>

<?php $this->endWidget(); ?>
