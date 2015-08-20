<?php
/* @var $this ExpertsController */
/* @var $model Experts */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'experts-form',
	'enableAjaxValidation'=>false,
)); ?>

    <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model,'type'); ?>
            <?php echo $form->dropDownList($model,'type',Experts::$type_label) ?>
            <?php echo $form->error($model,'type'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'sovet_id'); ?>
            <?php echo $form->dropDownList($model,'sovet_id',Experts::$sovet) ?>
            <?php echo $form->error($model,'sovet_id'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'fio'); ?>
            <?php echo $form->textField($model,'fio') ?>
            <?php echo $form->error($model,'fio'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone') ?>
            <?php echo $form->error($model,'phone'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <?php echo $form->textField($model,'email') ?>
            <?php echo $form->error($model,'email'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'contact_address'); ?>
            <?php echo $form->textField($model,'contact_address') ?>
            <?php echo $form->error($model,'contact_address'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'skills'); ?>
            <?php echo $form->textField($model,'skills') ?>
            <?php echo $form->error($model,'skills'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'education'); ?>
            <?php echo $form->textField($model,'education') ?>
            <?php echo $form->error($model,'education'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'scientific'); ?>
            <?php echo $form->textField($model,'scientific') ?>
            <?php echo $form->error($model,'scientific'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'profession_skill'); ?>
            <?php echo $form->textField($model,'profession_skill') ?>
            <?php echo $form->error($model,'profession_skill'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'history'); ?>
            <?php echo $form->textArea($model,'history') ?>
            <?php echo $form->error($model,'history'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'experience'); ?>
            <?php echo $form->textArea($model,'experience') ?>
            <?php echo $form->error($model,'experience'); ?>
        </div>


        <div class="row">
            <label>Ресурсы в сети</label>
        </div>

        <?php
        if(!empty($model->resources))
            foreach($model->resources as $key => $resources) : ?>
                <div class="input-group resource clearfix">
                    <div class="row">
                        <label>Ресурс в сети</label>
                        <?php echo CHtml::dropDownList('', $resources->type, $model_resourse->resources_type_site, array('class'=>'select')); ?>
                    </div>
                    <div class="row">
                        <label>Ссылка</label>
                        <?php echo CHtml::textField('',$resources->url); ?>
                    </div>
                    <div class="row buttons">
                        <label>&nbsp;</label>
                        <a href="#" data-id="<?php echo $resources->id?>" id="remove-item" class="btn btn-warning icon icon-trash">Удалить</a>
                    </div>
                </div>
        <?php endforeach; ?>

        <div id="after-copyed"></div>
        <a id="copy" href="">+ Добавить еще ресурс</a>

        <script>
            $(document).ready(function(){
                $('#copy').on('click',function(e){
                    var item = $('#app-view-2').html();
                    $(item).insertBefore('#after-copyed');
                    e.preventDefault();
                });

                $(document).on('click','#remove-item',function(e){
                    e.preventDefault();

                    var $this = $(this);

                    if($this.data('id')) {
                        $.post('/admin/experts/deleteResource?id='+$this.data('id'))
                            .success(function(data){
                                console.log(data);
                            });
                    }

                    $(this).closest('.input-group').remove();
                });
            });
        </script>

        <script id="app-view-2" type="text/template">
            <div class="input-group resource clearfix">
                <div class="row">
                    <label>Ресурс в сети</label>
                    <?php echo CHtml::dropDownList('ExpertsResources[type][]', $model_resourse->resources_type, $model_resourse->resources_type_site); ?>
                </div>
                <div class="row">
                    <label>Ссылка</label>
                    <?php echo CHtml::textField('ExpertsResources[url][]'); ?>
                </div>
                <div class="row buttons">
                    <label>&nbsp;</label>
                    <a href="#" id="remove-item" class="btn btn-warning icon icon-trash">Удалить</a>
                </div>
            </div>
        </script>




        <div class="row buttons">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->

