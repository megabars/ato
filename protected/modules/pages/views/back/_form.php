
<div class="form" ng-controller="FormCtrl">
<?php
/* @var $this Controller */
/* @var $model StaticPage */
/* @var $recordForm CActiveForm */

$recordForm = $this->beginWidget('CActiveForm', array(
    'id' => 'record-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'validateOnChange' => false,
    ),
)); ?>

    <div class="form-left">
        <?php if ($model->url_id !== null && !empty($model->url_id)): ?>
        <a href="<?php echo '/'.$model->url; ?>" target="_blank" class="fr link">Показать страницу</a>
        <?php endif; ?>
        <h1>Изменение страницы</h1>
        <?php echo $recordForm->errorSummary($model); ?>

        <div class="row">
            <!-- <?php echo $recordForm->labelEx($model, 'title'); ?> -->
            <?php echo $recordForm->textField($model, 'title', array('size' => 60, 'maxlength' => 255, 'placeholder' => $model->getAttributeLabel('title'))); ?>
            <?php echo $recordForm->error($model, 'title'); ?>
        </div>

        <div class="tabs">
            <?php
            $this->widget('zii.widgets.jui.CJuiTabs',array(
                'id' => 'add_page_static_tabs',
                'tabs'=> array(
                    'Содержимое' => $this->renderPartial('_content', array('model' => $model, 'form' => $recordForm), true),
                    'SEO' => $this->renderPartial('_seo', array('model' => $model->url, 'form' => $recordForm), true),
                    'Модули' => $this->renderPartial('_modules', array('model' => $model, 'recordForm' => $recordForm), true),
                ),
                'htmlOptions' => array(
                    'class' => 'nav-tabs'
                )
            ));
            ?>
        </div>
    </div>

    <div class="form-right">
        <div class="form-buttons">
            <button type="submit" class="btn icon icon-ok">Сохранить</button>
            <a href="<?php echo $this->createUrl('/pages/back/delete', array('id' => $model->id, 'type' => $model->type_id))?>" class="btn btn-warning icon icon-remove">Удалить</a>
        </div>

        <h3>Свойства</h3>

<!--        <div class="row">-->
<!--            <label>Тип страницы:</label>-->
<!--            <div class="radio-list">-->
<!--                --><?php //echo $recordForm->radioButtonList($model,'type_id', RecordType::instance()->list); ?>
<!--            </div>-->
<!--        </div>-->


        <div class="row">
            <label>Статус публикации:</label>
            <div class="radio-list">
                <?php echo $recordForm->radioButtonList($model,'state',array(
                    1 => 'Опубликовано',
                    0 => 'Черновик',
                    2 => 'Запланированно на',
                )); ?>

                <div class="timepicker">
                    <?php
                    $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                        'model' => $model,
                        'attribute' => 'date',
                        'options'=>array(
                            'dateFormat' => 'dd.mm.yy',
                            'timeFormat' => 'hh:mm',
                        ),
                    ));
                    ?>
                    <?php echo $recordForm->error($model, 'date'); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <label>Обновлено:</label>
            <div class="timepicker">
                <?php
                if (Yii::app()->user->isSuperuser) {
                $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                    'model' => $model,
                    'attribute' => 'modify',
                    'options'=>array(
                        'dateFormat' => 'dd.mm.yy',
                        'timeFormat' => 'hh:mm',
                    ),
                ));
                } else {
                    echo "<span class='updated'>".$model->modify."</span>";
                }
                ?>
                <?php echo $recordForm->error($model, 'modify'); ?>
            </div>

        </div>

        <div class="row">
            <label>Виджеты:</label>
            <div class="checkbox-list">
                <?php echo $recordForm->checkBox($model, 'info_thread'); ?>
                <?php echo $recordForm->labelEx($model, 'info_thread', array('style' => 'display: inline;')); ?>
                <?php echo $recordForm->error($model, 'info_thread'); ?>
            </div>

            <div class="checkbox-list">
                <?php echo $recordForm->checkBox($model, 'social'); ?>
                <?php echo $recordForm->labelEx($model, 'social', array('style' => 'display: inline;')); ?>
                <?php echo $recordForm->error($model, 'social'); ?>
            </div>
        </div>

        <h3>Миниатюра</h3>
        <div class="row">
            <!--<?php echo $recordForm->labelEx($model, 'image_id'); ?>-->
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'image_id')); ?>
            <?php echo $recordForm->error($model, 'image_id'); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>
</div>