<div class="uploader-wrapper <?php echo $display ? 'show' : ''; ?>">
    <div class="uploader-image-preview preview-file"><span><?php echo $filename ?></span></div>
    <span class="edit_file"></span>
    <span class="delete_file" data-id="<?php echo $id; ?>"></span>
    <?php echo CHtml::hiddenField($attrName, @$model->$attribute); ?>
</div>