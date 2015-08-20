<?php
/**
 * @var $this Controller
 * @var $record Smi
 */

$this->pageTitle = 'Томская область в СМИ';

$this->breadcrumbs = array(
    'Пресс-Центр',
    'Томская область в СМИ' => $this->createUrl('/smi/front/index'),
    $record->title,
);
?>

<div class="wrap">
    <h2><?php echo $record->title; ?></h2>
    <p class="date"><?php echo Rudate::date(date('d F, H:i', $record->date)); ?></p>
    <div class="text_body clearfix">
        <?php if($record->getMediumUrl('photo')): ?>
        <div class="image">
            <img src="<?php echo $record->getMediumUrl('photo'); ?>" />
            <span><?php echo $record->photo_title; ?></span>
        </div>
        <?php endif; ?>
        <div class="text">
            <?php echo $record->description; ?>
            <?php if ($record->source) : ?>
                <div>источник: <?php echo $record->source_link ? CHtml::link($record->source, $record->source_link) : $record->source; ?></div>
            <?php endif; ?>
            <div class="keywords">ключевые слова: <a href="">контракт</a>, <a href="">конкурс</a>, <a href="">компания</a> </div>
        </div>
    </div>
</div>

