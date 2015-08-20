<?php
/**
 * @var $this Controller
 * @var $step1_model ExpertsStep1Form
 * @var $step2_model ExpertsStep2Form
 * @var $step3_model ExpertsStep3Form
 * @var $step4_model ExpertsStep4Form
 * @var $step5_model ExpertsStep5Form
 * @var $step6_model ExpertsStep6Form
 */
$this->pageTitle = 'Регистрация эксперта';

$this->breadcrumbs = array(
//    'База данных экспертов'=>'/experts/front/index',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>

    <div class="form highlight-form">

        <p class="note"><span class="required">*</span> — Поля обязательные для заполнения</p>

        <div class="steps">
            <!-- шаг 1-->
            <?php $this->renderPartial('register/step1', array('model'=>$step1_model, 'modelSettings'=>$modelSettings)); ?>

            <!-- шаг 2-->
            <?php $this->renderPartial('register/step2', array('model'=>$step2_model)); ?>

            <!-- шаг 3-->
            <?php $this->renderPartial('register/step3', array('model'=>$step3_model)); ?>

            <!-- шаг 4-->
            <?php $this->renderPartial('register/step4', array('model'=>$step4_model)); ?>

            <!-- шаг 5-->
            <?php $this->renderPartial('register/step5', array('model'=>$step5_model)); ?>

            <!-- шаг 6-->
            <?php $this->renderPartial('register/step6', array('model'=>$step6_model)); ?>
        </div>

        <div class="step_navigation clearfix">
            <a href="#" class="fl btn" id="prev" style="display: none;"><i class="fl">&larr; </i> Назад</a>
            <a href="#" class="fr btn" id="next">Далее <i class="fr">&rarr; </i></a>
            <a href="#" class="fr btn" id="submit_all_form" style="display: none;">Зарегистрироваться</a>
        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        var stepForm = function() {
            var current,
                step,
                steps = $('.steps>div'),
                prevBtn = $('.step_navigation > a#prev'),
                nextBtn = $('.step_navigation > a#next'),
                submitBtn = $('.step_navigation > a#submit_all_form');

            prevBtn.on('click', function(){
                checkStep('prev');
                return false;
            });
            nextBtn.on('click', function(){
                checkStep('next');
                return false;
            });
            submitBtn.on('click', function(){
                checkStep('submit');
                return false;
            });

            function checkStep(action) {
                current = steps.filter(':visible');
                step = current.index();
                switch(action) {
                    case 'prev':
                        step -= 1;
                        stepAction();
                        break;
                    case 'next':
                        step += 1;
                        $('#expert-register-step' + step + '-form').submit();
                        $('.highlight-form').addClass('loader');
                        break;
                    case 'submit':
                        $('#expert-register-step' + (step+1) + '-form').submit();
                        $('.highlight-form').addClass('loader');
                        break;
                    default: break;
                }
            }

            function stepAction() {
                current.hide();
                steps.filter(':eq('+step+')').show();

                if(step<=0) prevBtn.hide();
                else prevBtn.show();

                if(step>=steps.size()-1) nextBtn.hide();
                else nextBtn.show();

                if(step==steps.size()-1) submitBtn.show();
                else submitBtn.hide();
            }

            function addNewSettings(form, formName, newLine, lineCount, attribute, attributeProperty){
                var nameAttributeProperty = (attributeProperty == '') ? '' : '['+attributeProperty+']';
                var idAttributeProperty = (attributeProperty == '') ? '' : '_'+attributeProperty;
                var newName = formName+'['+attribute+']'+nameAttributeProperty+'['+lineCount+']';
                var newId = formName+'_'+attribute+idAttributeProperty+'_'+lineCount;
                var newErrorId = newId+'_em_';

                var input = $(newLine).find('input#'+formName+'_'+attribute+idAttributeProperty)
                    .attr('name', newName)
                    .attr('id', newId);
                input.next('.errorMessage')
                    .attr('id',newErrorId);

                var settings = form.data('settings');
                var newAttribute = {
                    enableAjaxValidation: true,
                    errorCssClass: "error",
                    errorID: newErrorId,
                    hideErrorMessage: false,
                    id: newId,
                    inputID: newId,
                    model: formName,
                    name: attribute+nameAttributeProperty+'['+lineCount+']',
                    status: 1,
                    successCssClass: "success",
                    validateOnChange: true,
                    validateOnType: false,
                    validatingCssClass: "validating",
                    validationDelay: 20,
                    value: ""
                };
                settings.attributes.push(newAttribute);
                form.data('settings', settings);
            }

            function addNewAttributes(form, formName, newLine, lineCount, attribute, attributeProperty){
                if(attributeProperty instanceof Array) {
                    attributeProperty.forEach(function(property){
                        addNewSettings(form, formName, newLine, lineCount, attribute, property);
                    });
                } else {
                    addNewSettings(form, formName, newLine, lineCount, attribute, attributeProperty);
                }
            }

            return {
                action: function(){
                    stepAction();
                },
                submit: function(){
                    $('.highlight-form').addClass('loader');
                    var data = '';
                    $('.steps form').each(function(){
                        data += $(this).serialize()+'&';
                    });
                    $.ajax({
                        type: 'post',
                        url: '/experts/front/saveExpert',
                        data: data,
                        success: function(response){
                            response = JSON.parse(response);
                            if(response.status == 'success') {
                                if(document.referrer.indexOf('/experts/back/index'))
                                    location.assign(document.referrer); //если пришли из админки
                                else
                                    location.reload();
                            }
                            if(response.status == 'error') {
                                $('.highlight-form').removeClass('loader');
                                var message = '<div class="alert alert-error"><div class="alert-close"></div>'+response.message+'</div>';
                                $('.content').prepend(message);
                            }
                        }
                    })
                },
                addNewLine: function(self, lineCount, attribute, attributeProperty){
                    self.before(self.next().html());

                    var form = self.closest('form');
                    var formName = 'ExpertsStep'+Number(form.attr('id').replace(/\D+/g,""))+'Form';
                    var newLine = self.prev('.newRow');

                    if(attribute instanceof Array) {
                        attribute.forEach(function(attribute){
                            addNewAttributes(form, formName, newLine, lineCount, attribute, attributeProperty);
                        });
                    } else {
                        addNewAttributes(form, formName, newLine, lineCount, attribute, attributeProperty);
                    }
                }
            }
        };



        window.stepForm = stepForm();
    });
</script>