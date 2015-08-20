<?php
/**
 * @var $record Vote
 * @var $this Controller
 */

//$this->breadcrumbs = array(
//    'Опросы и рейтинги' => array('/vote/front/index'),
//    $record->title,
//);
?>

<div class="wrap content">
    <h1><?php echo $record->title; ?></h1>

    <div class="vote-list votes-detail">
        <div class="drop">
            <?php echo Yii::t('app', 'Статус опроса'); ?>: <span class="dropdown-menu"><?php echo $record->isActual() ? 'Актуальный' : 'Завершенный'; ?></span>
        </div>
        <div class="votes-block open">
            <?php Yii::app()->controller->renderPartial('_item', array('record' => $record, 'hideLink' => true, 'type' => $record->isActual())); ?>

            <i class="votes-count text-gray">
                <span><?php echo Yii::t('app', 'Всего проголосовало'); ?>: <?php echo $record->answersCount . ' ' . PluralEndings::getEnding($record->answersCount, 'человек', 'человека', 'человек'); ?> </span>
                <span><?php echo Yii::t('app', 'Голосвание открыто до'); ?> <?php echo (Yii::app()->language == 'de') ? date('d F Y', strtotime($record->finish)):Rudate::date(date('d F Y', strtotime($record->finish))); ?> <?php echo Yii::t('app', 'года'); ?></span>
            </i>
        </div>

    </div>
</div>