<div class="item">
    <div class="head">Журнал событий</div>
    <div class="body">
        <div class="block-history">
            <ul>
                <?php foreach ($log as $item) : ?>
                    <li>
                        <div class="user"><?php echo $item->userId; ?></div>
                        <div class="desc">
                            <span class="time"><?php echo date('d.m.y H:i', strtotime($item->date)); ?></span>
                            <span class="event"><?php echo $item->typeOfChange; ?> "<?php echo $item->changedModel; ?>"</span>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>