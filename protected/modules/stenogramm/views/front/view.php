<?php
/**
 * @var $this Controller
 * @var $record News
 */

$this->pageTitle = 'Стенограммы';

$this->breadcrumbs = array(
    'Пресс-Центр',
    'Стенограммы' => $this->createUrl('/stenogramm/front/index'),
    $record->title,
);
?>

<div class="wrap">
    <h2><?php echo $record->title; ?></h2>
    <p class="date"><?php echo Rudate::date(date('d F, H:i', strtotime($record->date))); ?></p>
    <div class="text_body clearfix">
        <div class="text">
            <?php echo $record->description; ?>
            <?php
                if ($record->url !== null && !empty($record->url->meta_keywods))
                    echo '<div class="hash-tag">Ключевые слова: '.$record->url->meta_keywods.'</div>';
            ?>

            <?php if ($record->social == 1): ?>
                <br/>
                <div class="clearfix">
                    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

