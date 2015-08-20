<div class="wrap">
    <h2>Фотогалерея</h2>
    <ul class="gallery-list clearfix">
        <?php foreach ($gallery as $item) { ?>
            <li>
                <a href="<?php echo $this->createUrl('/photoGallery/front/view', array('galleryId' => $item->id)) ?>">
                    <img src="<?php echo $item->getMediumUrl(); ?>"/>
                    <span class="desc"><?php echo $item->title; ?></span>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>