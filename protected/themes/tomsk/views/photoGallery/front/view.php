<?php
$this->breadcrumbs = array(
    'Пресс-Центр',
    'Фотогалереи' => array('/photoGallery/front/index'),
    $model->title);
?>
<div class="wrap">
    <h2>Фотогалерея</h2>
    <?php if($model->description) {?>
        <div class="gallery-description">
            <?php echo $model->description?>
        </div>
    <?php } ?>

    <ul class="gallery-list clearfix">
        <?php foreach ($model->photoGalleryPhotos as $img){ ?>
        <li>
            <a href="<?php echo $img->getImageUrl(); ?>" title="<?php echo $img->title ?>" rel="gallery" class="fancybox">
                <img src="<?php echo $img->getMediumUrl(); ?>"/>
            </a>
        </li>
        <?php } ?>
    </ul>

    <div class="clearfix">
        <div class="hr"></div>

        <div class="page-date">
            <b><?php echo Yii::t('app', 'Опубликовано:'); ?></b><?php echo $model->date; ?>
<!--            <span class="line">|</span>-->
<!--            <b>--><?php //echo Yii::t('app', 'Обновлено:'); ?><!--</b>--><?php //echo $model->modify; ?>
        </div>

        <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
    </div>
</div>