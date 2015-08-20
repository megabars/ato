<div id="step_4">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'expert-register-step4-form',
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

    <h4>Сведения об образовании и научной деятельности</h4>

    <div class="row education">
        <?php echo $form->labelEx($model,'education'); ?>
        <?php echo $form->hiddenField($model,'education'); ?>
        <?php echo $form->error($model,'education'); ?>
        <div class="input-group resource">
            <div class="row">
                <label>Год окончания</label>
                <?php echo $form->textField($model,'education[year][1]', array('maxlength'=>4)); ?>
                <?php echo $form->error($model,'education[year][1]'); ?>
            </div>
            <div class="input-group row">
                <div class="row">
                    <label>Специальность по диплому</label>
                    <?php echo $form->textField($model,'education[specialty][1]'); ?>
                    <?php echo $form->error($model,'education[specialty][1]'); ?>
                </div>
                <div class="row">
                    <label>Наименование учебного заведения</label>
                    <?php echo $form->textField($model,'education[institution][1]'); ?>
                    <?php echo $form->error($model,'education[institution][1]'); ?>
                </div>
            </div>
        </div>

        <a id="copy" href="">+ Добавить еще</a>

        <script id="education" type="text/template">
            <div class="input-group resource newRow">
                <div class="row">
                    <?php echo $form->textField($model,'education[year][]', array('maxlength'=>4)); ?>
                    <?php echo $form->error($model,'education[year][]'); ?>
                </div>
                <div class="input-group row">
                    <div class="row">
                        <?php echo $form->textField($model,'education[specialty][]'); ?>
                        <?php echo $form->error($model,'education[specialty][]'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->textField($model,'education[institution][]'); ?>
                        <?php echo $form->error($model,'education[institution][]'); ?>
                    </div>
                </div>
            </div>
        </script>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'degree'); ?>
        <div>
            <?php echo $form->radioButtonList($model, 'degree', array(1=>'Да', 0=>'Нет'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
        </div>
        <?php echo $form->hiddenField($model,'degrees'); ?>
        <?php echo $form->error($model,'degrees'); ?>

        <div class="row degrees">
            <div class="input-group resource">
                <div class="row">
                    <label>Год получения</label>
                    <?php echo $form->textField($model,'degrees[year][1]', array('maxlength'=>4)); ?>
                    <?php echo $form->error($model,'degrees[year][1]'); ?>
                </div>
                <div class="input-group row">
                    <div class="row">
                        <label>Полное наименование ученой степени</label>
                        <?php echo $form->textField($model,'degrees[name][1]'); ?>
                        <?php echo $form->error($model,'degrees[name][1]'); ?>
                    </div>
                    <div class="row">
                        <label>Документ, подтверждающий его получение</label>
                        <?php echo $form->textField($model,'degrees[document][1]'); ?>
                        <?php echo $form->error($model,'degrees[document][1]'); ?>
                    </div>
                </div>
            </div>

            <a id="copy" href="">+ Добавить еще</a>

            <script id="degrees" type="text/template">
                <div class="input-group resource newRow">
                    <div class="row">
                        <?php echo $form->textField($model,'degrees[year][]', array('maxlength'=>4)); ?>
                        <?php echo $form->error($model,'degrees[year][]'); ?>
                    </div>
                    <div class="input-group row">
                        <div class="row">
                            <?php echo $form->textField($model,'degrees[name][]'); ?>
                            <?php echo $form->error($model,'degrees[name][]'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->textField($model,'degrees[document][]'); ?>
                            <?php echo $form->error($model,'degrees[document][]'); ?>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'academic'); ?>
        <div>
            <?php echo $form->radioButtonList($model, 'academic', array(1=>'Да', 0=>'Нет'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
        </div>
        <?php echo $form->hiddenField($model,'academics'); ?>
        <?php echo $form->error($model,'academics'); ?>

        <div class="row academics">
            <div class="input-group resource">
                <div class="row">
                    <label>Год получения</label>
                    <?php echo $form->textField($model,'academics[year][1]', array('maxlength'=>4)); ?>
                    <?php echo $form->error($model,'academics[year][1]'); ?>
                </div>
                <div class="input-group row">
                    <div class="row">
                        <label>Полное наименование ученого звания</label>
                        <?php echo $form->textField($model,'academics[name][1]'); ?>
                        <?php echo $form->error($model,'academics[name][1]'); ?>
                    </div>
                    <div class="row">
                        <label>Документ, подтверждающий его получение</label>
                        <?php echo $form->textField($model,'academics[document][1]'); ?>
                        <?php echo $form->error($model,'academics[document][1]'); ?>
                    </div>
                </div>
            </div>

            <a id="copy" href="">+ Добавить еще</a>

            <script id="academics" type="text/template">
                <div class="input-group resource newRow">
                    <div class="row">
                        <?php echo $form->textField($model,'academics[year][]', array('maxlength'=>4)); ?>
                        <?php echo $form->error($model,'academics[year][]'); ?>
                    </div>
                    <div class="input-group row">
                        <div class="row">
                            <?php echo $form->textField($model,'academics[name][]'); ?>
                            <?php echo $form->error($model,'academics[name][]'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->textField($model,'academics[document][]'); ?>
                            <?php echo $form->error($model,'academics[document][]'); ?>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'honorary'); ?>
        <div>
            <?php echo $form->radioButtonList($model, 'honorary', array(1=>'Да', 0=>'Нет'), array('class'=>'styled', 'separator' => "&nbsp;&nbsp;&nbsp;")); ?>
        </div>
        <?php echo $form->hiddenField($model,'honoraries'); ?>
        <?php echo $form->error($model,'honoraries'); ?>

        <div class="row honoraries">
            <div class="input-group resource">
                <div class="row">
                    <label>Год получения</label>
                    <?php echo $form->textField($model,'honoraries[year][1]', array('maxlength'=>4)); ?>
                    <?php echo $form->error($model,'honoraries[year][1]'); ?>
                </div>
                <div class="input-group row">
                    <div class="row">
                        <label>Полное наименование почетного звания (степени)</label>
                        <?php echo $form->textField($model,'honoraries[name][1]'); ?>
                        <?php echo $form->error($model,'honoraries[name][1]'); ?>
                    </div>
                    <div class="row">
                        <label>Документ, подтверждающий его получение</label>
                        <?php echo $form->textField($model,'honoraries[document][1]'); ?>
                        <?php echo $form->error($model,'honoraries[document][1]'); ?>
                    </div>
                </div>
            </div>

            <a id="copy" href="">+ Добавить еще</a>

            <script id="honoraries" type="text/template">
                <div class="input-group resource newRow">
                    <div class="row">
                        <?php echo $form->textField($model,'honoraries[year][]', array('maxlength'=>4)); ?>
                        <?php echo $form->error($model,'honoraries[year][]'); ?>
                    </div>
                    <div class="input-group row">
                        <div class="row">
                            <?php echo $form->textField($model,'honoraries[name][]'); ?>
                            <?php echo $form->error($model,'honoraries[name][]'); ?>
                        </div>
                        <div class="row">
                            <?php echo $form->textField($model,'honoraries[document][]'); ?>
                            <?php echo $form->error($model,'honoraries[document][]'); ?>
                        </div>
                    </div>
                </div>
            </script>
        </div>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'publishing'); ?>
        <div class="input-group resource">
            <div class="row">
                <label>Общее количество</label>
                <?php echo $form->textField($model,'publishing_count'); ?>
                <?php echo $form->error($model,'publishing_count'); ?>
            </div>
            <div class="row">
                <label>Наиболее значимые</label>
                <?php echo $form->textArea($model,'publishing'); ?>
                <?php echo $form->error($model,'publishing'); ?>
            </div>
        </div>

        <?php echo $form->error($model,'publishing'); ?>
    </div>

    <div class="row further_education">
        <?php echo $form->labelEx($model,'further_education'); ?>
        <?php echo $form->hiddenField($model,'further_education'); ?>
        <?php echo $form->error($model,'further_education'); ?>
        <div class="input-group resource">
            <div class="row">
                <label>Год</label>
                <?php echo $form->textField($model,'further_education[year][1]', array('maxlength'=>4)); ?>
                <?php echo $form->error($model,'further_education[year][1]'); ?>
            </div>
            <div class="row">
                <label>Наименование</label>
                <?php echo $form->textField($model,'further_education[name][1]'); ?>
                <?php echo $form->error($model,'further_education[name][1]'); ?>
            </div>
        </div>

        <a id="copy" href="">+ Добавить еще</a>

        <script id="further_education" type="text/template">
            <div class="input-group resource newRow">
                <div class="row">
                    <?php echo $form->textField($model,'further_education[year][]', array('maxlength'=>4)); ?>
                    <?php echo $form->error($model,'further_education[year][]'); ?>
                </div>
                <div class="row">
                    <?php echo $form->textField($model,'further_education[name][]'); ?>
                    <?php echo $form->error($model,'further_education[name][]'); ?>
                </div>
            </div>
        </script>
    </div>

    <?php $this->endWidget(); ?>

    <script>
        $(document).ready(function(){

            /* EDUCATION */
            var educationLineCount = 1;
            $('.education #copy').on('click',function(e){
                educationLineCount++;
                stepForm.addNewLine($(this), educationLineCount, 'education', ['year', 'specialty', 'institution']);
                e.preventDefault();
            });

            /* DEGREE */
            var degreeLineCount = 1;
            $('#ExpertsStep4Form_degree input').on('ifChecked', function(){
                var degrees = $('.degrees');
                degrees.toggle();
            });
            $('.degrees #copy').on('click',function(e){
                degreeLineCount++;
                stepForm.addNewLine($(this), degreeLineCount, 'degrees', ['year', 'name', 'document']);
                e.preventDefault();
            });

            /* ACADEMIC */
            var academicLineCount = 1;
            $('#ExpertsStep4Form_academic input').on('ifChecked', function(){
                var academics = $('.academics');
                academics.toggle();
            });
            $('.academics #copy').on('click',function(e){
                academicLineCount++;
                stepForm.addNewLine($(this), academicLineCount, 'academics', ['year', 'name']);
                e.preventDefault();
            });

            /* HONORARY */
            var honoraryLineCount = 1;
            $('#ExpertsStep4Form_honorary input').on('ifChecked', function(){
                var honoraries = $('.honoraries');
                honoraries.toggle();
            });
            $('.honoraries #copy').on('click',function(e){
                honoraryLineCount++;
                stepForm.addNewLine($(this), honoraryLineCount, 'honoraries', ['year', 'name', 'document']);
                e.preventDefault();
            });

            /* FURTHER EDUCATION */
            var furtherEducationLineCount = 1;
            $('.further_education #copy').on('click',function(e){
                furtherEducationLineCount++;
                stepForm.addNewLine($(this), furtherEducationLineCount, 'further_education', ['year', 'name', 'document']);
                e.preventDefault();
            });
        });
    </script>

</div>