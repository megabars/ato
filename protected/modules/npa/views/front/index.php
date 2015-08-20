<?php
/**
 * @var $this Controller
 * @var $model Npa
 * @var $executive Contact
 */
$this->pageTitle = 'Проекты НПА';

$this->breadcrumbs = array(
    'Документы',
    'Проекты НПА',

);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle ?></h2>

    <div class="right-content">
        <div class="right-menu">
                <?php echo CHtml::link('Архив', '/npa/front/archive')?>
        </div>
    </div>
    <div class="left-content">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('/npa/front/index'),
        'id' => 'search-form',
        'method' => 'get',
    )); ?>
        <div class="grid-search">
            <div class="search-min clearfix">

                    <button type="submit" class="btn-default">Искать</button>
                    <div>
                        <?php echo $form->textField($model, 'title'); ?>
                    </div>

            </div>
        </div>
    <?php $this->endWidget(); ?>
    </div>
    <h4><?php echo $count . ' ' . PluralEndings::getEnding($count, 'документ', 'документа', 'документов'); ?></h4>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'docs-form',
        'dataProvider' => $model->search(),
        'cssFile' => FALSE,
        'ajaxUpdate' => TRUE,
        'itemsCssClass' => 'table',
        'template' => '{items}{pager}',
        'columns' => array(
            array(
                'header' => 'Исполнительный орган <br/>государственной власти, контакты',
                'name' => 'portal_id',
                'type' => 'raw',
                'value' => function($model) {
                    $executive_name = ($model->executive_id > 0) ? $model->executive->name : "Администрация Томской области";
                    $executive = Contact::model()->findByAttributes(array('executive_id'=>$model->executive_id));

                    echo '<h5><b>'.$executive_name.'</b></h5>';

                    if (isset($executive->address)) {
                        echo '<p>'.$executive->address.'</p>';
                    }

                    if (isset($executive->phone) && is_array($executive->phone)) {
                        echo '<p>Тел: ';
                        foreach($executive->phone as $phone)
                            echo '<a href="tel:'. $phone->value.'">'.$phone->value.'</a>, ';
                        echo '</p>';
                    }

                    if (isset($executive->fax) && is_array($executive->fax)) {
                        echo '<p>Факс: ';
                        foreach($executive->fax as $fax)
                            echo '<a href="tel:'. $fax->value.'">'.$fax->value.'</a>, ';
                        echo '</p>';
                    }

                    if (isset($executive->email) && is_array($executive->email)) {
                        echo '<p>E-mail: ';
                        foreach($executive->email as $email)
                            echo '<a href="mailto:'. $email->value.'">'.$email->value.'</a>, ';
                        echo '</p>';
                    }
                },
                'htmlOptions'=>array('class'=>'max200'),
            ),
            array(
                'header' => 'Проект нормативного правового акта',
                'name' => 'title',
                'type' => 'raw',
                'value' => function($data)
                {
                    if (isset($data->file))
                    {
                        $file = File::model()->resetScope()->findByPk($data->file);
                        return CHtml::link($data->title, File::model()->getFileUrl($file->id),array('target' => '_blank', 'class' => 'file file-pdf', 'title' => $data->title));
                    }
                    return $data->title;
                },
                'htmlOptions'=>array('class'=>'max400'),
            ),
            'type',
            array(
                'header' => 'Дата опубликования/обновления',
                'name' => 'date_actual',
                'type' => 'raw',
                'value' => function ($data) {
                    echo ($data->date_publish != 0) ? CHtml::tag("p", array(), "<b>Дата опубликования: </b>". date("d-m-Y", $data->date_publish)) : '';
                    echo ($data->date_actual != 0) ? CHtml::tag("p", array(), "<b>Дата обновления: </b>" . date("d-m-Y H:i", $data->date_actual)) : '';
                },
            ),
        ),
        'pager' => array(
            'header' => '',
            'cssFile' => FALSE,
            'firstPageLabel' => '&larr;&nbsp;&nbsp;Первая',
            'prevPageLabel' => '&larr;&nbsp;&nbsp;Предыдущая',
            'nextPageLabel' => 'Следующая&nbsp;&nbsp;&rarr;',
            'lastPageLabel'=> 'Последняя&nbsp;&nbsp;&rarr;',
        ),
    )); ?>
</div>

