<?php
/**
 * @var $this Controller
 * @var $record News
 */

$this->pageTitle = 'Новости';

$this->breadcrumbs = array(
    'Новости' => $this->createUrl('/news/front/index'),
    $record->title,
);
?>

<div class="wrap">
    <h2><?php echo $record->title; ?></h2>
    <p class="date"><?php echo Rudate::date(date('d F, H:i', strtotime($record->date))); ?></p>
    <div class="text_body clearfix">
        <?php if($record->getMediumUrl('photo')): ?>
            <div class="image">
                <img src="<?php echo $record->getMediumUrl('photo'); ?>" />
                <span><?php echo $record->photo_title; ?></span>
            </div>
        <?php endif; ?>
        <div class="text">
            <?php echo $record->description; ?>
            <?php
            if ($record->url !== null && !empty($record->url->meta_keywods))
                echo '<div class="hash-tag">Ключевые слова: <span>'.$record->url->meta_keywods.'</span></div>';
            ?>

            <div class="clearfix">
                <div class="hr"></div>

                <div class="page-date">
                    <b>Опубликовано:</b><?php echo $record->date; ?>
                    <span class="line">|</span>
                    <b>Обновлено:</b><?php echo $record->modify; ?>
                </div>
                <?php if ($record->social == 1): ?>
                    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

