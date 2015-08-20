<?php
/**
 * @var $this FrontController
 * @var $model AcPublic[]
 * @var $categories CategoryPost
 */
?>

<?php foreach($categories as $category): ?>
    <div class="item">
        <div class="title">
            <div class="name"><?php echo $category->name; ?></div>
            <div class="toggle"></div>
        </div>
        <div class="desc">
            <table class="simple-table">
                <tbody>
                <?php foreach($model as $item): ?>
                    <?php if($item->post_type_id == $category->id): ?>
                        <tr>
                            <td><?php echo $item->fio; ?>, <?php echo $item->post; ?></td>
                            <td class="text-right width130">
                                <a href="<?php echo $item->getFileUrl($item->file); ?>">Скачать</a>
                                <div class="file-simple"><?php echo $item->originFile->ext; ?> <?php echo File::getFileSize($item->file, 'Mb'); ?></div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endforeach; ?>