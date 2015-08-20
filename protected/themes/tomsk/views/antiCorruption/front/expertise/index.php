<?php
/**
 * @var $this FrontController
 * @var $model AcExpertise
 */

$this->pageTitle = 'Независимая антикоррупциионная экспертиза';

$this->breadcrumbs = array(
    'Противодействие коррупции',
    $this->pageTitle
);
?>

<div class="wrap invalid-version">
    <h2><?php echo $this->pageTitle; ?></h2>
    <div class="clearfix">

        <?php $this->renderPartial('_menu'); ?>

        <div class="left-content">

            <div class="table-filter">
                <?php $this->renderPartial('_search'); ?>

                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'ac-expertise-grid',
                    'dataProvider'=>$model->search(),
                    'cssFile' => false,
                    'ajaxUpdate'=>true,
                    'itemsCssClass' => 'table',
                    'template' => '{items}{pager}',
                    'columns'=>array(
                        array(
                            'header' => 'Исполнительный орган государственной власти',
                            'name' => 'executive_id',
                            'type' => 'raw',
                            'value' => function($data) {
                                $executive_name = ($data->executive_id > 0) ? $data->executive->name : "Администрация Томской области";
                                $executive = Contact::model()->findByAttributes(array('executive_id'=>$data->executive_id));

                                echo '<h5><b>'.Portal::model()->findByPk($data->portal_id)->title.'</b></h5>';

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
                            'htmlOptions'=>array(
                                'class'=>'max300'
                            )
                        ),
                        array(
                            'header'=>'Проект нормативного правового акта',
                            'name'=>'file',
                            'type' => 'raw',
                            'value'=>function ($data) {
                                return '<div>'.$data->title.'</div>
                                        <div class="link">
                                            <a href="http://'. Portal::model()->findByPk($data->portal_id)->alias . '/antiCorruption/front/expertise/id/'.$data->id.'">Перейти к документу</a>
                                        </div>' . ($data->file ?
                                        '<div class="link">
                                            <a href="http://'. Portal::model()->findByPk($data->portal_id)->alias . Yii::app()->createUrl('/files/front/download', array('id' => $data->file)).'">Скачать '.@$data->originFile->ext.' '.File::getFileSize($data->file, "Mb").'</a>
                                        </div>' : '');
                            },
                            'htmlOptions'=>array(
                                'class'=>'max300'
                            )
                        ),
                        array(
                            'header'=>'Срок проведения независимой антикоррупционной экспертизы',
                            'type' => 'raw',
                            'value'=>function ($data) {
                                return '<p><b>Начало:</b>'.date("d.m.Y", $data->date_start).'</p>
                                        <p><b>Окончание:</b>'.date("d.m.Y", $data->date_finish).'</p>
                                        <p><b>Размещено:</b>'.date("d.m.Y", $data->date_publish).'</p>';
                            }
                        ),
                    ),
                    'pager'=>array(
                        'header'=>'',
                        'cssFile'=>false,
                        'firstPageLabel'=> false,
                        'prevPageLabel'=>'&larr;&nbsp;&nbsp;Предыдущая',
                        'nextPageLabel'=>'Следующая&nbsp;&nbsp;&rarr;',
                        'lastPageLabel'=> false,
                    ),
                )); ?>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#search').submit(function(event){
            $.fn.yiiGridView.update('ac-expertise-grid', {
                data: {AcExpertise: {title: $(this).find('input[type="text"]').val()}}
            });
            event.preventDefault();
        });
    });
</script>