<?php
/** @var $comment Comment */

$countComments = count($comments);
?>

<div>
    <div style="margin-top: 30px;" class="wrap">
        <div class="block">
            <div class="head">
                <span class="title"><?php echo $countComments . ' ' . PluralEndings::getEnding($countComments, 'Комментарий', 'Комментария', 'Комментариев'); ?></span>
            </div>

            <ul class="comments">
                <?php if(count($comments) > 0):?>
                    <?php foreach($comments as $comment) : ?>
                            <li>
                                <div class="item">
<!--                                    <div class="avatar">-->
<!--                                        <img src="--><?php //echo $creator->profile->getSmallUrl(); ?><!--">-->
<!--                                    </div>-->

                                    <div class="item-body">
                                        <div class="name"><?php echo Rudate::date(date('d F Y', $comment->create_time)); ?> <?php echo $comment->user_name;?> написал:</div>
<!--                                        <div class="name">--><?php //echo $comment->user_email;?><!--</div>-->

                                        <div class="message">
                                            <?php echo $comment->comment_text; ?>
                                        </div>

                                        <div class="date">
<!--                                            --><?php //echo Rudate::date(date('d F Y', $comment->create_time)); ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php endforeach; ?>

<!--                    <li class="comment-form">-->
<!--                        --><?php //$this->widget('comments.widgets.ECommentsFormWidget', array('model' => $this->model)); ?>
<!--                    </li>-->
                <?php else:?>
                    <li>Пока никто не оставил комментариев</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>



