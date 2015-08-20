<?php
/** @var $this Controller */
?>

<div class="right-slider">
    <h2>Губернатор</h2>
    <div class="slide" style="background-image: url('<?php echo $guber->getSmallUrl('photo'); ?>');">
        <ul>
            <?php foreach ($model as $item) : ?>
                <li>
                    <div class="item">
                        <div class="desc">
                            <div class="link">
                                <a href="#" class="prev"></a>
                                <a href="#" class="next"></a>
                                <a target="_blank" href="<?php echo $item->url; ?>" class="a"><?php echo $item->title; ?></a>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="name"><?php echo $guber->fio ?></div>
    <p class="pagination"></p>
</div>