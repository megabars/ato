<div id="step_5">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'expert-register-step5-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>false,
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
            'afterValidate' => 'js: function(form, data, hasError) {
                $(".highlight-form").removeClass("loader");
                if(!hasError)
                    stepForm.action();
                return false;
            }'
        )
    )); ?>

    <h4>Сведения о профессиональной деятельности</h4>

    <div class="row">
        <?php echo $form->labelEx($model,'professional_interests'); ?>
        <?php echo $form->error($model,'professional_interests'); ?>
        <span id="ExpertsStep5Form_professional_interests">
            <?php foreach ($model->interests_list as $key => $item): ?>
                <?php  if($key % 2 == 0):?>
                    <div class="input-group">
                <?php endif; ?>
                <div class="row">
                    <?php echo CHtml::checkBox('ExpertsStep5Form[professional_interests][]', '', array(
                        'class'=>'styled',
                        'id'=>'ExpertsStep5Form_professional_interests_'.$key,
                        'value' => $item
                    )); ?>
                    <label for="<?php echo 'ExpertsStep5Form_professional_interests_'.$key; ?>"><?php echo $item; ?></label>
                </div>
                <?php  if(count($model->interests_list) % 2 == 1 && $key == count($model->interests_list)-1):?>
                    <div class="row"></div>
                <?php endif; ?>
                <?php  if($key % 2 == 1 || $key == count($model->interests_list)-1):?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </span>
        <div class="row professional_interests">
            <label>Иная</label>
            <div class="row" >
                <?php echo $form->textField($model,'professional_interests[text][1]'); ?>
                <?php echo $form->error($model,'professional_interests[text][1]'); ?>
            </div>

            <a id="copy" href="">+ Добавить еще</a>

            <script id="professional_interests" type="text/template">
                <div class="row newRow" >
                    <?php echo $form->textField($model,'professional_interests[text][]'); ?>
                    <?php echo $form->error($model,'professional_interests[text][]'); ?>
                </div>
            </script>
        </div>

    </div>

    <div class="row experience">
        <?php echo $form->labelEx($model,'experience'); ?>
        <?php echo $form->hiddenField($model,'experience'); ?>
        <?php echo $form->error($model,'experience'); ?>
        <div class="input-group resource">
            <div class="row">
                <label>Период</label>
                <?php echo $form->textField($model,'experience[period][1]'); ?>
                <?php echo $form->error($model,'experience[period][1]'); ?>
            </div>
            <div class="input-group row">
                <div class="row">
                    <label>Наименование организации</label>
                    <?php echo $form->textField($model,'experience[organization][1]'); ?>
                    <?php echo $form->error($model,'experience[organization][1]'); ?>
                </div>
                <div class="row">
                    <label>Должность</label>
                    <?php echo $form->textField($model,'experience[post][1]'); ?>
                    <?php echo $form->error($model,'experience[post][1]'); ?>
                </div>
            </div>
        </div>

        <a id="copy" href="">+ Добавить еще</a>

        <script id="experience" type="text/template">
            <div class="input-group resource newRow">
                <div class="row">
                    <?php echo $form->textField($model,'experience[period][]'); ?>
                    <?php echo $form->error($model,'experience[period][]'); ?>
                </div>
                <div class="input-group row">
                    <div class="row">
                        <?php echo $form->textField($model,'experience[organization][]'); ?>
                        <?php echo $form->error($model,'experience[organization][]'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model,'experience[post][]'); ?>
                        <?php echo $form->error($model,'experience[post][]'); ?>
                    </div>
                </div>
            </div>
        </script>
    </div>

    <div class="input-group">
        <div class="row">
            <?php echo $form->labelEx($model,'skill'); ?>
            <?php echo $form->textArea($model,'skill'); ?>
            <?php echo $form->error($model,'skill'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'achievements'); ?>
            <?php echo $form->textArea($model,'achievements'); ?>
            <?php echo $form->error($model,'achievements'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

    <script>
        $(document).ready(function(){
            /* PROFESSIONAL INTERESTS */
            var professionalInterestsLineCount = 1;
            $('.professional_interests #copy').on('click',function(e){
                professionalInterestsLineCount++;
                stepForm.addNewLine($(this), professionalInterestsLineCount, 'professional_interests', 'text');
                e.preventDefault();
            });

            /* EXPERIENCE */
            var experienceLineCount = 3;
            $('.experience #copy').on('click',function(e){
                experienceLineCount++;
                stepForm.addNewLine($(this), experienceLineCount, 'experience', ['period', 'organization', 'post']);
                e.preventDefault();
            });
        });
    </script>
</div>