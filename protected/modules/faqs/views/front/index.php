<?php
/**
 * @var $this Controller
 * @var $records Faqs[]
 */

$this->pageTitle = 'Часто задаваемые вопросы';

//$this->breadcrumbs = array(
//    'Часто задаваемые вопросы'
//);
?>

<div class="wrap opendata">
    <h2>Часто задаваемые вопросы</h2>

    <div class="clearfix">
        <ul class="faq">
            <?php foreach ($records as $record) : ?>
                <li>
                    <span><?php echo $record->question; ?></span>
                    <div><?php echo $record->answer; ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php $this->widget('application.extensions.custom.customPager', array('pages' => $pages)); ?>

<div class="push"></div>