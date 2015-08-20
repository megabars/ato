<?php
/**
 * @var $records Vote[]
 * @var $this Controller
 */
?>

<div class="wrap">
    <h2><?php echo Yii::t('app', 'Опросы'); ?></h2>

    <div class="votes">
        <div class="tabs clearfix">
            <a class="<?php echo ($type == 1)?'active':'' ?>" href="<?php echo $this->createUrl('/vote/front')?>"><?php echo Yii::t('app', 'Актуальные опросы'); ?></a>
            <a class="<?php echo ($type == 2)?'active':'' ?>" href="<?php echo $this->createUrl('/vote/front', array('type'=>2))?>"><?php echo Yii::t('app', 'Завершенные'); ?></a>
        </div>

        <div class="votes-list">
            <ul class="clearfix">
                <?php if($pages->getCurrentPage() == 0 && $type == 1 && $last !== null) : ?>
                    <li class="first">
                        <div class="last-vote">
                            <div class="left">
                                <div class="title"><?php echo $last->title; ?></div>
                                <div class="info">
                                    <div class="count"><?php echo Yii::t('app', 'Проголосовало'); ?>: <?php echo $last->answersCount; ?></div>
                                    <div><?php echo Yii::t('app', 'Голосование'); ?> <?php echo ($type == 1)? Yii::t('app', 'открыто до') : Yii::t('app', 'закрыто') ?> <?php echo (Yii::app()->language == 'de') ? date('d F Y', strtotime($last->finish)):Rudate::date(date('d F Y', strtotime($last->finish))); ?> <?php echo Yii::t('app', 'года'); ?></div>
                                </div>
                            </div>
                            <div class="variations">
                                <?php Yii::app()->controller->renderPartial('_item_first', array('record' => $last)); ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php foreach ($records as $index=>$record) : ?>
                    <li class="row">
                        <div class="item">
                            <div class="title"><?php echo $record->title; ?></div>
                            <?php Yii::app()->controller->renderPartial('_item', array('record' => $record, 'type' => $type)); ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php $this->widget('application.widgets.customPager', array('pages' => $pages)); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
    <?php if($pages->getCurrentPage() == 0) { ?>
        $('.votes-list > ul > .row:nth-child(2n)').each(function(){
            if( $(this).height() > $(this).next().height()) {
                $(this).next().find('.item').outerHeight($(this).height())
            }
            else
                $(this).find('.item').outerHeight($(this).next().height())
        });
    <?php } else { ?>
        $('.votes-list > ul > .row:nth-child(2n)').each(function(){
            if( $(this).height() > $(this).prev().height()) {
                $(this).prev().find('.item').outerHeight($(this).height())
            }
            else
                $(this).find('.item').outerHeight($(this).prev().height())
        });
    <?php } ?>
        function update_row(){
            if( $('.last-vote .left .title').outerHeight() + 107 > $('.last-vote .variations').outerHeight() ) {
                $('.last-vote .variations').height($('.last-vote .left .title').outerHeight() + 107)
            }
        }
        update_row();
        setTimeout(function(){
            update_row();
        },1000)
    });
</script>