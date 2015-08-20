<?php
/**
 * @var $data PhotoGallery
 */

$itemCount=$widget->dataProvider->getItemCount();
?>
<?php echo ($index==0)? CHtml::openTag('li'):""; ?>
<a href="<?php echo $this->createUrl('/photoGallery/front/view/galleryId/'. $data->id); ?>" class="item">
    <span class="hover"><span><?php echo $data->title; ?></span></span>
    <img src="<?php echo $data->getSmallUrl(); ?>"/>
</a>
<?php if(($index+1)%2==0 && $index!=$itemCount-1){
    echo "</li><li>";
}
echo ($index==$itemCount-1)? CHtml::closeTag('li'):"";
?>

