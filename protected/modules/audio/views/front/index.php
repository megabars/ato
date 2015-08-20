<?php
/**
// * @var $this Controller
 * @var $records Audio[]
 */

$this->pageTitle = 'Аудиоархив';

//$this->breadcrumbs = array(
//    'Аудиоархив'
//);
?>

<div class="wrap">
    <h2>Аудиоархив</h2>

    <ul class="item_list">
        <?php foreach ($records as $record) : ?>
            <div><?php echo $record->title; ?></div>
            <div>
                <audio controls>
                    <source src="<?php echo Audio::model()->getFileUrl($record->mp3); ?>" type="audio/mpeg">
                    <source src="<?php echo Audio::model()->getFileUrl($record->wav); ?>" type="audio/wav">
                    Тег audio не поддерживается вашим браузером.
                    <a href="<?php echo Audio::model()->getFileUrl($record->file); ?>">Скачайте файл</a>.
                </audio>
            </div>
        <?php endforeach; ?>
    </ul>

    <div class="clearfix">
        <div class="hr"></div>
        <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
    </div>
</div>