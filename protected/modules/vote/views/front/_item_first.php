<?php

$voteCount = VoteUser::model()->countByAttributes(array('vote_id' => $record->id, 'ip_address' => $this->user_ip_address));
?>

<?php if ($record->isClosedAndNonPublish()) : ?>
    <?php if ($record->isActual() && !$voteCount) : ?>

        <form class="vote-form" action="<?php echo Yii::app()->createUrl('/vote/front/save'); ?>" method="post">
            <input type="hidden" name="vote_id" value="<?php echo $record->id; ?>" />

            <ul>
                <?php foreach ($record->items as $item) : ?>
                    <li>
                        <label>
                            <input class="styled" type="radio" name="vote" value="<?php echo $item->id; ?>" />
                            <span class="label"><?php echo $item->title; ?></span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="buttons">
                <input type="submit" class="btn" value="<?php echo Yii::t('app', 'Проголосовать'); ?>">
            </div>
        </form>
    <?php else : ?>
        <?php echo Yii::t('app', 'Данные опроса будут опубликованы позже'); ?>
    <?php endif; ?>

<?php else : ?>
    <?php if ($record->isActual() && !$voteCount) : ?>

        <form class="vote-form" action="<?php echo Yii::app()->createUrl('/vote/front/save'); ?>" method="post">
            <input type="hidden" name="vote_id" value="<?php echo $record->id; ?>" />

            <ul>
                <?php foreach ($record->items as $item) : ?>
                    <li>
                        <label>
                            <input class="styled" type="radio" name="vote" value="<?php echo $item->id; ?>" />
                            <span class="label"><?php echo $item->title; ?></span>
                        </label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="buttons">
                <input type="submit" class="btn" value="<?php echo Yii::t('app', 'Проголосовать'); ?>">
            </div>
        </form>

    <?php endif; ?>

    <div class="vote-result" style="<?php echo !$record->isActual() ? '' : (!$voteCount ? 'display: none;' : ''); ?>">
        <ul>
            <?php foreach ($record->items as $item) : ?>
                <?php $percent = ($record->answersCount > 0) ? round($item->answersCount / $record->answersCount, 4) * 100 : 0; ?>
                <li>
                    <div class="label">
                        <span class="percent"><?php echo $percent; ?>%</span>
                        <span class="name"><?php echo $item->title; ?></span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $percent; ?>%;"></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if ($record->isActual() && !$voteCount) : ?>
            <a href="#" class="btn" onclick="var $wrapper = $(this).closest('.vote-wrapper'); $wrapper.find('.votes-result').hide(); $wrapper.find('.vote-form').fadeIn(); return false;">
                <?php echo Yii::t('app', 'Проголосовать'); ?>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>