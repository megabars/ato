<div class="uploader-wrapper <?php echo $display ? 'show' : ''; ?>">
    <div class="uploader-image-preview" style="background-image: url('<?php echo $img_src; ?>')">
        <?php echo $filename; ?><span class="file-size"><?php echo Filesize::format_size($size); ?></span>
    </div>
    <span class="edit_file"></span>
    <span class="delete_file" data-id="<?php echo $id; ?>"></span>
    <?php echo CHtml::activeHiddenField($model, $attribute); ?>
</div>