<ul class="form_menu">
    <?php foreach (FeedbackType::instance()->list as $index => $item) : ?>
        <li class="<?php echo ($index == $type) ? 'active' : ''; ?>">
            <?php echo CHtml::link($item, $this->createUrl('/feedback/front/index', array('type' => $index))); ?>
        </li>
    <?php endforeach; ?>
</ul>