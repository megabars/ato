<?php
/**
 * @var $data News
 */
Yii::import('news.enums.ImageType');
?>
<li>
    <div class="item">
        <a href="<?php echo Yii::app()->controller->createUrl('/news/front/view/', array('id' => $data->id)); ?>" class="photo">

            <?php if ($data->default_image) : ?>
                <img src="<?php echo Yii::app()->controller->assetsBase . '/images/news/' . ImageType::instance()->list[$data->default_image] . '.png'; ?>" />
            <?php else : ?>
                <img src="<?php echo ($data->photo)? $data->getSmallUrl('photo') : $this->assetsBase.'/images/image.png'; ?>"/>
            <?php endif; ?>


        </a>
        <div class="date"><?php echo Rudate::date(date('d F Y', strtotime($data->date))); ?></div>
        <div class="title">
            <a href="<?php echo Yii::app()->controller->createUrl('/news/front/view/', array('id' => $data->id)); ?>">
                <?php echo $data->title; ?>
            </a>
        </div>
    </div>
</li>