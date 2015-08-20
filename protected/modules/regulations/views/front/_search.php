
<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>


<div class="text-right"><a href="" id="max-search">Расширенный поиск</a></div>

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'id'=>'search-docs',
    'method'=>'post',
    'htmlOptions'=> array(
        'class' => 'search-min clearfix'
    )
)); ?>

    <?php echo CHtml::submitButton('Искать', array('class'=>'btn-default')); ?>
    <div>
        <?php echo $form->textField($model,'preview'); ?>
    </div>

    <div class="checked-list" id="max-search-content" style="display: none;">
        <div class="collapsed hide">
            <div class="title">Дата утверждения документа</div>
            <div class="body" style="display: none;">
                <div class="input-group" id="range-date">
                    <div class="group">
                        с
                        <?php
                        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                            'model' => $documents,
                            'attribute' => 'dateStart',
                            'mode' => 'date',
                            'options'=>array(
                                'showAnim' => 'drop',
                                'dateFormat' => 'dd.mm.yy',
                                'showOtherMonths'=>true,// Show Other month in jquery
                                'selectOtherMonths'=>true,// Select Other month in jquery
                                'beforeShow' => 'js:function(input, inst) {
                                               $("#ui-datepicker-div").removeClass(function() {
                                                   return $("input").get(0).id;
                                               });
                                               $("#ui-datepicker-div").addClass(this.id);
                                            }',
                                'onSelect' => 'js:function(){
                                                updateDocs();
                                            }',
                                'onClose' => 'js:function(selectedDate){
                                                $( "#date_end" ).datepicker( "option", "minDate", selectedDate );
                                            }',
                            ),
                            'htmlOptions' => array(
                                'class' => 'date',
                                'id'=>'date_start',
                                'placeholder' => 'дд.мм.гггг'
                            )
                        ));
                        ?>
                    </div>
                    <div class="group">
                        по
                        <?php
                        $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                            'model' => $documents,
                            'attribute' => 'dateEnd',
                            'mode' => 'date',
                            'options'=>array(
                                'showAnim' => 'drop',
                                'dateFormat' => 'dd.mm.yy',
                                'showOtherMonths'=>true,// Show Other month in jquery
                                'selectOtherMonths'=>true,// Select Other month in jquery
                                'onSelect' => 'js:function(){
                                                updateDocs();
                                            }',
                                'onClose' => 'js:function(selectedDate){
                                                $( "#date_start" ).datepicker( "option", "maxDate", selectedDate );
                                            }',
                            ),
                            'htmlOptions' => array(
                                'class' => 'date',
                                'id'=>'date_end',
                                'placeholder' => 'дд.мм.гггг'
                            )
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->endWidget(); ?>

