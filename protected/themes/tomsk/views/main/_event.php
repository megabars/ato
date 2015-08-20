<div class="head-carousel">
    <div class="stage">
        <div class="carousel carousel-stage">
            <ul>
                <?php foreach($events as $event): ?>
                    <?php $link = (!empty($event->external_link)) ? $event->external_link.'" target="_blank' : '/'.(isset($event->url)) ? $event->url : ''; ?>
                    <li>
                        <a href="<?php echo $link; ?>">
                            <img src="<?php echo ($event->image !== null)? $event->image->getFileUrl($event->image->id):""; ?>">
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <p class="jcarousel-pagination"></p>
    </div>

    <div class="navigation">
        <div class="carousel carousel-navigation">
            <ul>
                <?php foreach($events as $event) : ?>
                    <?php $link = (!empty($event->external_link)) ? $event->external_link.'" target="_blank' : '/'.$event->url; ?>
                    <li>
                        <a href="<?php echo $link; ?>"><?php echo $event->title; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>