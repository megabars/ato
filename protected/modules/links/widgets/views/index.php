<?php
/** @var $records Links[] */
$count = count($records);
?>

<?php if ($count) : ?>
    <?php if ($count > 4) : ?>
        <div class="wigets-link">
            <ul>
                <?php foreach ($records as $record) : ?>
                    <li>
                        <a target="_blank" href="<?php echo $record->url; ?>">
                            <span class="image">
                                <img src="<?php echo $record->getSmallUrl('photo'); ?>" />
                            </span>
                            <span class="txt"><?php echo $record->title; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <a href="#" class="prev"></a>
            <a href="#" class="next"></a>
        </div>
    <?php else : ?>
        <div class="wigets-link">
            <ul style="text-align: center; width: 100%;; position: static;">
                <?php foreach ($records as $record) : ?>
                    <li style="display: inline-block; float: none; top: 0; vertical-align: top;">
                        <a target="_blank" href="<?php echo $record->url; ?>">
                                <span class="image">
                                    <img src="<?php echo $record->getSmallUrl('photo'); ?>" />
                                </span>
                            <span class="txt"><?php echo $record->title; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>