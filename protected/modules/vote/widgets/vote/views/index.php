<?php /** @var $record Vote */ ?>

<?php if ($record) : ?>
    <h3><?php echo Yii::t('app', 'Опрос'); ?></h3>
    <div class="vote-block">
        <div class="padding_block20 index-votes">
            <h2><?php echo $record->title; ?></h2>

            <?php Yii::app()->controller->renderPartial('application.modules.vote.views.front.last', array('record' => $record)); ?>
        </div>

        <div class="foot clearfix">
            <a href="<?php echo Yii::app()->createUrl('/vote/front/index'); ?>"><?php echo Yii::t('app', 'Все опросы'); ?></a>
        </div>
    </div>
<?php endif; ?>

