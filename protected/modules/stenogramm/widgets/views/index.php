<?php /** @var $records News[] */ ?>

<?php if (count($records)) : ?>
    <div class="last_news">
        <div class="title">
            <a href="<?php echo Yii::app()->createUrl('/news/front/index'); ?>">
                Все новости
            </a>
            Новости
        </div>

        <ul class="list">
            <?php foreach ($records as $record) : ?>
                <li class="clearfix">
                    <?php if(isset($record->photo)): ?>
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