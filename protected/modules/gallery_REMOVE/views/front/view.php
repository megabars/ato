<?php
/**
 * @var $this Controller
 * @var $records Video[]
 */

$this->pageTitle = 'Видеогалерея';

$this->breadcrumbs = array(
    'Видеогалерея'
);
?>
<div class="wrap">
    <h2>Видеогалерея</h2>
    <ul class="video-list clearfix">
        <?php foreach ($records as $record) : ?>
            <li>
                <?php if ($record->link) : ?>
                    <a class="fancy-video fancybox.iframe" href="<?php echo $record->link; ?>">
                        <img src="<?php echo $record->getSmallUrl('photo'); ?>" />
                    </a>
                <?php else : ?>
                    <div>
                        <video controls="controls" preload="metadata">
                            <source src="<?php echo BaseActiveRecord::getFileUrl($record->mp4); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
                            <source src="<?php echo BaseActiveRecord::getFileUrl($record->ogv); ?>" type='video/ogg; codecs="theora, vorbis"'>
                            <source src="<?php echo BaseActiveRecord::getFileUrl($record->webm); ?>" type='video/webm; codecs="vp8, vorbis"'>
                        </video>
                        <p class="desc"><?php echo $record->title; ?></p>
                        <p class="date"><?php echo Rudate::date(date('d F Y, H:i', $record->date)); ?></p>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>