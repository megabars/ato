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
                <img src="<?php echo ($item->photo) ? $item->getMediumUrl('photo') : $this->assetsBase.'/images/image.png'; ?>"/>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>