<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>
	
	<div class="row">
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
		<?php echo $form->error($model, 'itemname'); ?>
	</div>

    <div class="row">
        <label>Выберите портал(только для администраторов субпортала): </label>
        <?php echo $form->dropDownList($model, 'data', Portal::bizzRulesArray()); ?>
        <?php echo $form->error($model, 'data'); ?>
    </div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton(Rights::t('core', 'Assign')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>