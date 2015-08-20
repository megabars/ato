<?php
/**
 * @var $this Controller
 * @var $records Video[]
 */

$this->pageTitle = 'Видеогалерея';

//$this->breadcrumbs = array(
//    'Видеогалерея'
//);
?>
<div class="wrap">
    <h2>Видеогалерея</h2>
    <ul class="video-list clearfix">
        <?php foreach ($records as $record) : ?>
            <li>
                <p class="desc"><?php echo $record->title; ?></p>
                <?php if ($record->link) : ?>
                    <div>
                        <a class="fancy-video fancybox.iframe" href="<?php echo $record->link; ?>">
                            <?php preg_match("/\?v=(?P<content>.+?)(&+|$)/isu", $record->link, $matches);
                            $imgUrl = (isset($record->photo))? File::getFileUrl($record->photo) : "http://img.youtube.com/vi/".@$matches['content']."/hqdefault.jpg"; ?>
                            <img width="100%" height="220px" src="<?php echo $imgUrl; ?>" />
                        </a>
                    </div>
                <?php else : ?>
                    <?php if ($record->ogv && $record->webm) : ?>
                        <div>
                            <a class="fancy-video" href="#video<?php echo $record->id ?>">
                                <?php if (isset($record->photo)):; ?>
                                    <img width="100%" height="220px" src="<?php echo File::getFileUrl($record->photo); ?>" />
                                <?php else: ?>
                                    <div style="width: 100%; height: 220px; background: #000"></div>
                                <?php endif; ?>
                            </a>
                            <span class="title"><?php echo $record->title; ?></span>
                            <div style="display: none;">
                                <div id="video<?php echo $record->id ?>">
                                    <video controls="controls" preload="none" width="800">
                                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->mp4); ?>" type='video/mp4;'>
                                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->ogv); ?>" type='video/ogg; codecs="theora, vorbis"'>
                                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->webm); ?>" type='video/webm; codecs="vp8, vorbis"'>
                                    </video>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div>
                            Данное видео обрабатывается. В скором времени оно будет доступно.
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <p class="date"><?php echo $record->date; ?></p>
                <div class="desc"><?php echo $record->description; ?></div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php $this->widget('application.widgets.customPager', array('pages' => $pages)); ?>
    <br/>
    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
    <br/>


</div>