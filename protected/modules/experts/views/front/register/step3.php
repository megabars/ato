<div id="step_3">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'expert-register-step3-form',
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

    <h4>Персональная информация</h4>

    <div class="input-group row">
        <div class="row">
            <?php echo $form->labelEx($model,'fio'); ?>
            <?php echo $form->textField($model,'fio', array('placeholder'=>'Фамилия, имя, отчество')); ?>
            <?php echo $form->error($model,'fio'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'birthday'); ?>
            <?php $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'attribute' => 'birthday',
                'mode' => 'date',
                'options'=>array(
                    'dateFormat' => 'dd.mm.yy',
                    'timeFormat' => 'hh:mm',
                    'changeYear' => true,
                    'changeMonth' => true,
                    'yearRange' => '1910:2015',
                ),
            )); ?>
            <?php echo $form->error($model,'birthday'); ?>
        </div>
    </div>

    <div class="row input-group">
        <div class="row emails">
            <div class="row">
                <?php echo $form->labelEx($model,'emails'); ?>
                <?php echo $form->textField($model, 'emails[1]'); ?>
                <?php echo $form->error($model,'emails[1]'); ?>
            </div>

            <a id="copy" href="">+ Добавить еще email</a>

            <script id="emails" type="text/template">
                <div class="row newRow">
                    <?php echo $form->textField($model, 'emails[]'); ?>
                    <?php echo $form->error($model,'emails[]'); ?>
                </div>
            </script>
        </div>

        <div class="row phones">
            <div class="row">
                <?php echo $form->labelEx($model,'phones'); ?>
                <?php $this->widget('CMaskedTextField', array(
                    'name' => 'ExpertsStep3Form[phones][1]',
                    'mask' => '+7(999) 999-99-99',
                    'placeholder' => '*',
                    'htmlOptions' => array('placeholder'=>'Например, +7(917) 123-45-67')
                )); ?>
                <?php echo $form->error($model,'phones[1]'); ?>
            </div>

            <a id="copy" href="">+ Добавить еще номер</a>

            <script id="phones" type="text/template">
                <div class="row newRow">
                    <?php $this->widget('CMaskedTextField', array(
                        'name' => 'ExpertsStep3Form[phones][]',
                        'mask' => '+7(999) 999-99-99',
                        'placeholder' => '*',
                        'htmlOptions' => array(
                            'placeholder'=>'Например, +7(917) 123-45-67',
                            'class'=>'masked'
                        )
                    )); ?>
                    <?php echo $form->error($model,'phones[]'); ?>
                </div>
            </script>
        </div>
    </div>

    <div class="row resources">
        <div class="input-group resource">
            <div class="row">
                <label>Ресурсы в сети</label>
                <?php echo CHtml::dropDownList('','', $model->resources_list, array('class'=>'select', 'id'=>'select_resources')); ?>
            </div>
            <div class="row multiple">
                <label>Ссылка</label>
                <div class="row">
                    <?php echo $form->textField($model, 'sites[1]'); ?>
                    <?php echo $form->error($model,'sites[1]'); ?>
                </div>
                <div class="row">
                    <?php echo $form->textField($model, 'socials[1]', array('style'=>'display: none;')); ?>
                    <?php echo $form->error($model,'socials[1]'); ?>
                </div>
                <div class="row">
                    <?php echo $form->textField($model, 'blogs[1]', array('style'=>'display: none;')); ?>
                    <?php echo $form->error($model,'blogs[1]'); ?>
                </div>
            </div>
        </div>

        <a id="copy" href="">+ Добавить еще ресурс</a>

        <script id="resources" type="text/template">
            <div class="input-group resource newRow">
                <div class="row">
                    <?php echo CHtml::dropDownList('','', $model->resources_list, array('class'=>'select', 'id'=>'select_resources')); ?>
                </div>
                <div class="row multiple">
                    <div class="row">
                        <?php echo $form->textField($model, 'sites[]'); ?>
                        <?php echo $form->error($model,'sites[]'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model, 'socials[]', array('style'=>'display: none;')); ?>
                        <?php echo $form->error($model,'socials[]'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model, 'blogs[]', array('style'=>'display: none;')); ?>
                        <?php echo $form->error($model,'blogs[]'); ?>
                    </div>
                </div>
            </div>
        </script>
    </div>

    <div class="input-group row">
        <div class="row">
            <div class="row">
                <?php echo $form->labelEx($model,'citizenship'); ?>
                <div>
                    <?php echo CHtml::radioButtonList('ExpertsStep3Form[citizenship_type]', 0, array('Российская Федерация', 'Иное'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
                </div>
                <?php echo $form->textField($model,'citizenship', array('id'=>'other_citizenship', 'style'=>'display: none;', 'value' => 'Российская Федерация')); ?>
                <?php echo $form->error($model,'citizenship'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'address'); ?>
                <div>
                    <?php echo CHtml::radioButtonList('ExpertsStep3Form[address_type]', 0, array('Томская область', 'Иное'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
                </div>
                <?php echo $form->dropDownList($model,'address_id', $model->region_list, array('class'=>'select', 'id'=>'address_list')); ?>
                <?php echo $form->textField($model,'address', array('id'=>'other_region', 'style'=>'display: none;')); ?>
                <?php echo $form->error($model,'address'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'restriction'); ?>
                <div>
                    <?php echo $form->radioButtonList($model, 'restriction', array('Нет', 'Да'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
                </div>
                <?php echo $form->error($model,'restriction'); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model,'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model,'photo'); ?>
            <?php echo CHtml::closeTag('div'); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

    <script>
        $(document).ready(function(){
            /* EMAILS */
            var emailsLineCount = 1;
            $('.emails #copy').on('click',function(e){
                emailsLineCount++;
                stepForm.addNewLine($(this), emailsLineCount, 'emails', '');
                e.preventDefault();
            });

            /* PHONES */
            var phonesLineCount = 1;
            $('.phones #copy').on('click',function(e){
                phonesLineCount++;
                stepForm.addNewLine($(this), phonesLineCount, 'phones', '');
                $(".masked").mask("+7(999) 999-99-99",{'placeholder':'*'});
                e.preventDefault();
            });


            /* RESOURCES */
            $('.resources').on('change', '#select_resources', function(){
                var inputs = $(this).closest('.resource').find(':text');
                inputs.val('').hide().next('.errorMessage').text('').hide();
                inputs.filter('[id *= "'+$(this).val()+'"]').show();
            });
            var resourcesLineCount = 1;
            $('.resources #copy').on('click',function(e){
                resourcesLineCount++;
                stepForm.addNewLine($(this), resourcesLineCount, ['sites', 'socials', 'blogs'], '');
                $(".select").selecter();
                e.preventDefault();
            });

            $('#ExpertsStep3Form_citizenship_type input').on('ifChecked', function(){
                var input = $('#other_citizenship');
                input.toggle();
                var text = input.is(':visible') ? '':'Российская Федерация';
                input.val(text);
            });

            $('#ExpertsStep3Form_address_type input').on('ifChecked', function(){
                var input = $('#other_region'),
                    select = $('#address_list').closest('.selecter');
                input.toggle();
                select.toggle();
                var text = input.is(':visible') ? '': select.find('#address_list').val();
                input.val(text);
            });
        });
    </script>

</div>

