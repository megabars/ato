<?php /** @var $records News[] */ ?>

<?php if (count($records)) : ?>
    <div class="last_news">
        <div class="title">
            <a href="<?php echo Yii::app()->createUrl('/news/front/index'); ?>">
                 <?php echo Yii::t('app', 'Все новости'); ?>
            </a>
            <?php echo Yii::t('app', 'Новости'); ?>
        </div>

        <ul class="list">
            <?php foreach ($records as $record) : ?>
                <li class="clearfix">
                    <?php if ($record->default_image) : ?>
                        <img src="<?php echo Yii::app()->controller->assetsBase . '/images/news/' . ImageType::instance()->list[$record->default_image] . '.png'; ?>" />
                    <?php elseif(isset($record->photo)): ?>
                        <img src="<?php echo $record->getSmallUrl('photo'); ?>" />
                    <?php endif; ?>
                    <div>
                        <p>
                            <a href="<?php echo Yii::app()->createUrl('/news/front/view', array('id' => $record->id)); ?>">
                                <?php echo $record->title; ?>
                            </a>
                        </p>
                        <p><?php echo $record->preview; ?></p>
                        <p class="bottom">
                            <?php if  (($author = $record->getAuthorName()) !== null): ?>
                            <a href="#<?php echo $author->id; ?>" class="fl"><?php echo $author ? $author->username : ''; ?></a>
                            <?php endif; ?>
                            <span class="fr"><?php echo Rudate::date(date('d F', $record->date)); ?></span>
                        </p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>