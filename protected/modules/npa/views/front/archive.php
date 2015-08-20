<?php
/**
 * @var $this Controller
 * @var $model Npa
 * @var $executive Contact
 */
$this->pageTitle = 'Проекты НПА';

$this->breadcrumbs = array(
    'Документы',
    'Проекты НПА' => '/npa/front/index',
    'Архив'

);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle ?></h2>

    <div class="grid-search">
            <?php $this->renderPartial('_search', array('model' => $model)); ?>
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
                'header' => 'Исполнительный орган государственной власти, контакты',
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
                'htmlOptions'=>array('class'=>'max300'),
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
                'header' => 'Срок проведения общественных обсуждений',
                'name' => 'date_actual',
                'type' => 'raw',
                'value' =>
                    'CHtml::tag("p", array(), "<b>Дата опубликования: </b>". date("d-m-Y H:i", $data->date_publish)) .
                     CHtml::tag("p", array(), "<b>Дата актуализации: </b>" . date("d-m-Y H:i", $data->date_actual)) .
                     CHtml::tag("p", array(), "<b>Дата завершения: </b>" . date("d-m-Y H:i", $data->date_finish))',
            ),
        ),
        'pager' => array(
            'header' => '',
            'cssFile' => FALSE,
            'firstPageLabel' => FALSE,
            'prevPageLabel' => '&larr;&nbsp;&nbsp;Предыдущая',
            'nextPageLabel' => 'Следующая&nbsp;&nbsp;&rarr;',
            'lastPageLabel' => FALSE,
        ),
    )); ?>
</div>

