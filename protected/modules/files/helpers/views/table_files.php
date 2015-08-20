<div class="qq-table-files">
<!--    <div class="download-count">Загружено 3 файла</div>-->
    <div class="qq-table-files-list">
        <?php foreach ($existFiles as $item) : ?>
            <div class="fileitem">
                <img src="<?php echo $item->getSmallUrl('photo'); ?>"/>
                <div class="filename"><?php echo (isset($item->file)) ?$item->file->origin_name : 'undef' ?></div>
                <span class="delete_file_multi" data-id="<?php echo $item->photo ?>"></span>
                <input name="<?php echo get_class($model).'['.$attribute; ?>][]" value="<?php echo $item->photo ?>" type="hidden"/>
            </div>
        <?php endforeach; ?>
    </div>
</div>