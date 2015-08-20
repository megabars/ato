<div class="last-news last-news-full">
<ul class="items">
    <?php foreach ($data as $item): ?>
<li>
    <div class="item">
        <a href="<?php echo Yii::app()->controller->createUrl('/smi/front/view/', array('id' => $item->id)); ?>" class="photo">
            <img src="<?php echo ($item->photo)? $item->getSmallUrl('photo') : $this->assetsBase.'/images/image.png'; ?>"/>
        </a>
        <div class="date"><?php
            echo Rudate::date(date('d F Y', strtotime($item->date)));
//            echo $item->date;
            ?></div>
        <div class="title">
            <a href="<?php echo Yii::app()->controller->createUrl('/smi/front/view/', array('id' => $item->id)); ?>">
                <?php echo $item->title; ?>
            </a>
        </div>
    </div>
</li>
    <?php endforeach; ?>

</ul>
</div>