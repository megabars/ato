<?php
/**
 * @var $data PhotoGallery
 */

$itemCount=$widget->dataProvider->getItemCount();
?>

<li>
    <a href="<?php echo $data->getImageUrl(); ?>" rel="gallery" class="item fancybox">
        <span class="hover"><span><?php echo $data->title; ?></span></span>
        <img src="<?php echo $data->getSmallUrl(); ?>"/>
    </a>
</li>