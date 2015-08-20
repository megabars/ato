<tr class="gallery-photo">
    <?php echo CHtml::hiddenField("{$name}[$id][photo]", $item ? $item['photo'] : null, array('class' => 'photo-id')); ?>
    <?php echo CHtml::hiddenField("{$name}[$id][ordi]", $item ? $item['ordi'] : null, array('class' => 'photo-sort')); ?>

    <td class="gallery-image">
        <?php echo $item ? CHtml::image($item->getSmallUrl('photo'), $item['title'], array('width' => 50, 'height' => 50)) : ''; ?>
    </td>
    <td class="gallery-title">
        <?php echo CHtml::textField("{$name}[$id][title]", $item ? $item['title'] : ''); ?>
    </td>
    <td class="gallery-state">
        <?php echo CHtml::checkBox("{$name}[$id][state]", $item ? $item['state'] : 0); ?>
    </td>
    <td>
        <?php echo CHtml::link('вверх', Yii::app()->createUrl('#'), array('class' => 'sort-up')); ?>
        <?php echo CHtml::link('вниз', Yii::app()->createUrl('#'), array('class' => 'sort-down')); ?>
        <?php echo CHtml::link('удалить', Yii::app()->createUrl('#'), array('class' => 'drop-photo')); ?>
    </td>
</tr>