<?php
/**
 * @var $this Controller
 * @var $records News[]
 */

$this->pageTitle = 'События региона';

$this->breadcrumbs = array(
    'События региона'
);
?>

<div class="wrap">
    <h2><?php echo $this->pageTitle; ?></h2>

    <ul class="news_list">
        <?php if($records): ?>
            <?php foreach ($records as $key => $item): ?>
                <?php  if($key % 2 == 0):?>
                    <li>
                <?php endif; ?>
                <div>
                    <?php  if($item->getSmallUrl('photo')):?>
                        <img src="<?php echo $item->getSmallUrl('photo'); ?>" />
                    <?php endif; ?>

                    <h3>
                        <a href="<?php echo $this->createUrl("/events/front/view/", array('id' => $item->id)); ?>">
                            <?php echo $item->title; ?>
                        </a>
                    </h3>
                    <p class="date"><?php echo Rudate::date(date('d F, H:i', strtotime($item->date))); ?></p>
                    <div><?php echo strip_tags($item->preview); ?></div>
                </div>
                <?php  if(count($records) % 2 == 1 && $key == count($records)-1):?>
                    <div></div>
                <?php endif; ?>
                <?php  if($key % 2 == 1 || $key == count($records)-1):?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>

    <?php $this->widget('application.widgets.customPager', array('pages' => $pages)); ?>
</div>



