<?php
/* @var $this AdminController */
/* @var $model News */
/* @var $newsForm CActiveForm */
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'gallery-form',
    'enableAjaxValidation' => false,
    'enableClientValidation'=>true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => true,
        'afterValidate' => 'js: function(form, data, hasError) {
                if (!hasError) {
                    $.ajax({
                        type: "POST",
                        url: "/pages/pageGallery/update/id/'.$model->id.'",
                        data: form.serialize(),
                        success: function(data) {
                            $("#gallery_dialog").dialog("close");
                            form[0].reset();
                            $.fn.yiiGridView.update("galleryGrid");
                        }
                    });
                    return false;
                }
            }')
)); ?>

<div class="width-80">
    <div class="row">
        <!--    --><?php //echo $form->labelEx($model, 'photos'); ?>
        <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photoGalleryPhotos', 'multiple' => true)); ?>
        <?php echo $form->error($model, 'photos'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn')); ?>
    </div>
</div>


<?php $this->endWidget(); ?>