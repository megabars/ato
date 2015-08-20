<?php
/**
 * @var $this Controller
 */
$this->pageTitle = 'Ход рассмотрения';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Обращения',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Обращения граждан</h2>
    <h3><?php echo $this->pageTitle; ?></h3>

    <div class="clearfix">
        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">
            <div class="form">
                <form action="" method="" id="status">
                    <div class="row inline">
                        <label>
                            Номер обращения
                            <?php
                            $this->widget('CMaskedTextField', array(
                                'name' => 'code',
                                'mask' => '999-999-999-999',
                                'placeholder' => '0',
                            ));
                            ?>
                        </label>
                        <?php echo CHtml::ajaxSubmitButton('Найти', '/appeal/front/status', array(
                            'type' => 'post',
                            'beforeSend' => 'js:function(data){
                                $("#result").html("");
                            }',
                            'success' => 'js:function(data){
                                $("#result").html(data);
                            }',
                            'error' => 'js:function(data){
                                $("#result").text("Сервис временно не доступен. Попробуйте позднее.");
                            }'
                        ), array(
                            'class'=>'btn small'
                        )) ?>
                    </div>
                </form>
            </div>
            <div id="result" style="margin-top: 35px;"></div>
        </div>
    </div>
</div>