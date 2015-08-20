<?php
/** @var $this AdminController */
/** @var $model Staff */

$this->breadcrumbs = array(
    'Документы',
    'Формы обращений и заявлений'
);
?>

<div class="wrap invalid-version">
    <h2>Формы обращений и заявлений</h2>
    <div class="clearfix">
        <div class="table-filter">

        <div class="grid-search">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'action' => Yii::app()->createUrl('/forms/front/index'),
                'id' => 'search-form',
                'method' => 'get',
            )); ?>

                <div class="search-min clearfix">
                    <button type="submit" class="btn-default">Искать</button>
                    <div>
                        <?php echo $form->textField($model, 'service', array('maxlength' => 255)); ?>
                    </div>
                </div>
            <?php $this->endWidget(); ?>
        </div>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $model->search(),
//            'filter' => $model,
            'enablePagination' => true,
            'enableSorting' => true,
            'cssFile' => false,
            'itemsCssClass' => 'table',
            'summaryText' => '',
            'template' => "{summary}{items}{pager}",
            'columns' => array(
                array(
                    'name' => 'portal_id',
                    'type' => 'raw',
                    'value' => '@Portal::model()->findByPk($data->portal_id)->title',
                    'sortable' => true,
                ),
                array(
                    'name' => 'service',
                    'sortable' => true,
                ),
                array(
                    'name' => 'file',
                    'type' => 'raw',
                    'value' => 'CHtml::link(@File::model()->allPortalsCriteria()->findByPk($data->file)->origin_name, File::getFileUrl($data->file))',
                    'sortable' => true,
                ),
            ),
        ));
        ?>

        <br/>
    </div>
</div>