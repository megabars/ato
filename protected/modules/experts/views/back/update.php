<?php
/** @var $model Experts */
/** @var $this BackController */


$this->pageTitle = 'Редактирование эксперта';

$this->breadcrumbs = array(
//    'Экспертные советы' => '/experts/council',
    'База данных экспертов' => '/experts/back',
    $this->pageTitle
);
?>

    <div class="page-header">
        <h2><?php echo $this->pageTitle; ?></h2>
    </div>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'experts-form',
        'enableAjaxValidation' => false,
    )); ?>
    <div class="form-left">
        <?php echo $form->errorSummary($model); ?>
        <div role="tabpanel" class="tabs">

            <ul class="nav-tabs" role="tablist">
                <li class="active"><a href="#tab-1" aria-controls="tab-1" role="tab" data-toggle="tab" class="active">Основные сведения</a></li>
                <li><a href="#tab-2" aria-controls="tab-2" role="tab" data-toggle="tab">Дополнительные сведения</a></li>
                <li><a href="#tab-3" aria-controls="tab-3" role="tab" data-toggle="tab">Контакты</a></li>
            </ul>

            <div class="tab-content">
                <!-- Основные сведения -->
                <div role="tabpanel" class="tab-pane active" id="tab-1">
                    <div class="row">
                        <label>ФИО</label>
                        <div><?php echo $model->fio; ?></div>
                    </div>
                    <div class="row">
                        <label>Дата рождения</label>
                        <div><?php echo date('d.m.Y', strtotime($model->birthday)); ?></div>
                    </div>
                    <div class="row">
                        <label>Гражданство</label>
                        <div><?php echo $model->citizenship; ?></div>
                    </div>
                    <?php if(!empty($model->address)): ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'address'); ?>
                        <div><?php echo $model->address; ?></div>
                    </div>
                    <?php endif; ?>
                    <div class="row">
                        <label>Наличие решений суда, связанных с ограничениями прав</label>
                        <div><?php echo ($model->restriction) ? 'Да' : 'Нет'; ?></div>
                    </div>
                    <div class="row">
                        <label>Образование (специальность по диплому)</label>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Год окончания</th>
                                <th>Специальность по диплому</th>
                                <th>Наименование учебного заведения</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($model->education as $education): ?>
                            <tr>
                                <td><?php echo $education->year; ?></td>
                                <td><?php echo $education->specialty; ?></td>
                                <td><?php echo $education->institution; ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <label>Опыт работы (три последних места работы начиная с текущего)</label>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Период</th>
                                <th>Наименование организации</th>
                                <th>Должность</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($model->experience as $experience): ?>
                                <tr>
                                    <td><?php echo $experience->period;; ?></td>
                                    <td><?php echo $experience->organization; ?></td>
                                    <td><?php echo $experience->post; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if(count($model->additional_education)>0): ?>
                        <div class="row">
                            <label>Дополнительное образование (курсы, семинары и т.п.)</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Год</th>
                                    <th>Наименование</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($model->additional_education as $additional_education): ?>
                                    <tr>
                                        <td><?php echo $additional_education->year; ?></td>
                                        <td><?php echo $additional_education->additional; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if($model->degree): ?>
                        <div class="row">
                            <label>Ученая степень</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Год получения</th>
                                    <th>Полное наименование ученой степени</th>
                                    <th>Документ, подтверждающий его получение</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($model->degrees as $degree): ?>
                                    <tr>
                                        <td><?php echo $degree->year;; ?></td>
                                        <td><?php echo $degree->name; ?></td>
                                        <td><?php echo $degree->document; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if($model->academic): ?>
                        <div class="row">
                            <label>Ученое звание</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Год получения</th>
                                    <th>Полное наименование ученой степени</th>
                                    <th>Документ, подтверждающий его получение</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($model->academics as $academic): ?>
                                    <tr>
                                        <td><?php echo $academic->year;; ?></td>
                                        <td><?php echo $academic->name; ?></td>
                                        <td><?php echo $academic->document; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                    <?php if($model->honorary): ?>
                        <div class="row">
                            <label>Почетное звание (степень)</label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Год получения</th>
                                    <th>Полное наименование ученой степени</th>
                                    <th>Документ, подтверждающий его получение</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($model->honoraries as $honorary): ?>
                                    <tr>
                                        <td><?php echo $honorary->year;; ?></td>
                                        <td><?php echo $honorary->name; ?></td>
                                        <td><?php echo $honorary->document; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Дополнительные сведения -->
                <div role="tabpanel" class="tab-pane" id="tab-2">
                    <div class="row">
                        <label>Сфера профессиональных интересов</label>
                        <div><?php echo $model->professional_interests; ?></div>
                    </div>
                    <?php if(!empty($model->publishing_count)): ?>
                        <div class="row">
                            <label>Количество публикаций в научных журналах</label>
                            <div><?php echo $model->publishing_count; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->publishing)): ?>
                        <div class="row">
                            <label>Наиболее значимые публикации</label>
                            <div><?php echo $model->publishing; ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <label>Ключевые профессиональные компетенции</label>
                        <div><?php echo $model->skill; ?></div>
                    </div>
                    <?php if(!empty($model->achievements)): ?>
                        <div class="row">
                            <label>Основные профессиональные достижения за последние три года</label>
                            <div><?php echo $model->achievements; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->achievements)): ?>
                        <div class="row">
                            <label>Основные профессиональные достижения за последние три года</label>
                            <div><?php echo $model->achievements; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->prospect)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'prospect'); ?>
                            <div><?php echo $model->prospect; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->public_organization)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'public_organization'); ?>
                            <div><?php echo $model->public_organization; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->expert_work)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'expert_work'); ?>
                            <div><?php echo $model->expert_work; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->wish)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'wish'); ?>
                            <div><?php echo $model->wish; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->project)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'project'); ?>
                            <div><?php echo $model->project; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->qualification)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'qualification'); ?>
                            <div><?php echo $model->qualification; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($model->additional_information)): ?>
                        <div class="row">
                            <?php echo $form->labelEx($model, 'additional_information'); ?>
                            <div><?php echo $model->additional_information; ?></div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Контакты -->
                <div role="tabpanel" class="tab-pane" id="tab-3">
                    <div class="form">
                        <div class="row">
                            <label><?php echo (count($model->phones)==1 ? 'Контактный телефон' : 'Контактные номера'); ?></label>
                            <div><?php echo $model->getContact(); ?></div>
                        </div>
                        <?php if(count($model->emails)): ?>
                            <div class="row">
                                <label><?php echo (count($model->sites)==1 ? 'Электронный адрес' : 'Электронные адреса'); ?></label>
                                <div><?php echo $model->getContact('emails'); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if(count($model->sites)): ?>
                            <div class="row">
                                <label><?php echo (count($model->sites)==1 ? 'Сайт' : 'Сайты'); ?></label>
                                <div><?php echo $model->getContact('sites'); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if(count($model->blogs)): ?>
                            <div class="row">
                                <label><?php echo (count($model->blogs)==1 ? 'Блог' : 'Блоги'); ?></label>
                                <div><?php echo $model->getContact('blogs'); ?></div>
                            </div>
                        <?php endif; ?>
                        <?php if(count($model->socials)): ?>
                            <div class="row">
                                <label><?php echo (count($model->socials)==1 ? 'Социальная сеть' : 'Социальные сети'); ?></label>
                                <div><?php echo $model->getContact('socials'); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-right">
        <div class="form-buttons">
            <button type="submit" class="btn icon icon-ok">Сохранить</button>
            <?php if(!$model->getIsNewRecord()): ?>
                <a href="<?php echo $this->createUrl('/experts/back/create', array('id'=>$model->id))?>" class="btn btn-warning icon icon-remove" id="remove">Удалить</a>
            <?php endif; ?>
        </div>

        <div class="row">
            <label>Дата и время отправки заявки:</label>
            <div><?php echo $model->date; ?></div>
        </div>
        <div class="row">
            <label>Экспертный совет</label>
            <div><?php echo $model->expert_council->name; ?></div>
        </div>
        <div class="row">
            <label>Статус эксперта:</label>
            <div class="radio-list">
                <?php echo $form->radioButtonList($model,'state', $model::$statuses, array('ng-scope'=>'state')); ?>
                <?php echo $form->error($model, 'state'); ?>
            </div>
            <div id="post" <?php if($model->state != $model::STATUS_ACCEPTED): ?>style="display: none;"<?php endif; ?>>
                <?php echo $form->labelEx($model,'post'); ?>
                <?php echo $form->textField($model,'post',array('max'=>500)); ?>
                <?php echo $form->error($model,'post'); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model, 'photo'); ?>
        </div>

    </div>
    <?php $this->endWidget(); ?>
</div>
<script>
    $(document).ready(function(){
        $('#Experts_state').on('change', ':radio', function(){
            if($(this).val()==<?php echo $model::STATUS_ACCEPTED; ?>)
                $('#post').show();
            else
                $('#post').hide();
        });
        $('#remove').on('click', function(){
            if(!confirm('Вы действительно хотите удалить данного эксперта?')) {
                return false;
            }
        })
    });
</script>