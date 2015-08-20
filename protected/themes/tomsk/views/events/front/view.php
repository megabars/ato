<?php
/**
 * @var $this Controller
 * @var $record Page
 */

$this->pageTitle = 'События региона';

$this->breadcrumbs = array(
    'События региона' => $this->createUrl('/events/front/index'),
    $record->title,
);
?>

<div class="wrap">
    <h2><?php echo $record->title; ?></h2>
    <p class="date"><?php echo Rudate::date(date('d F, H:i', strtotime($record->date))); ?></p>
    <div class="text_body clearfix">
        <?php if($record->getMediumUrl('file_id')): ?>
            <div class="image">
                <img src="<?php echo $record->getMediumUrl('file_id'); ?>" />
            </div>
        <?php endif; ?>
        <div class="text">
            <?php echo $record->description; ?>
        </div>
    </div>
</div>

