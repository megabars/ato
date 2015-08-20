<?php
/* @var $this PageSeoController */
/* @var $model PageSeo */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'meta_description'); ?>
        <?php echo $form->textArea($model,'meta_description',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'meta_description'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'meta_keywods'); ?>
        <?php echo $form->textArea($model,'meta_keywods',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($model,'meta_keywods'); ?>
    </div>
</div>

<div class="seo-info">
    <h3>Описание для полей</h3>
    <p><b>Заголовок страницы</b> - отображается в названии окна или вкладки браузера. Также содержание title отображается в выдаче поисковых систем по запросам пользователей</p>
    <p><b>Адрес</b> - это индивидуальный адрес страницы портала, по которому мы можем найти нужную страницу.</p>
    <p><b>Описание страницы (Meta Description)</b> - используется поисковыми системами для индексации, а также при создании аннотации в выдаче по запросу. При отсутствии тега поисковые системы выдают в аннотации первую строку документа или отрывок, содержащий ключевые слова.</p>
    <p><b>Ключевые слова (Meta Keywods)</b> - используется поисковыми системами чтобы определить релевантность ссылки. Необходимо использовать только те слова, которые содержатся в самом документе. Рекомендованное количество слов в данном теге — не более десяти.</p>
    <p>Пример ввода: природа, животные, субботник</p>
</div>
