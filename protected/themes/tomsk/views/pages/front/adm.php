<?php
/**
 * @var $this Controller
 * @var $page Page
 */
?>
<div class="wrap">
    <h2><?php echo $page->title; ?></h2>
    <div class="custom-content"><?php echo $page->description; ?></div>

    <?php if (isset($page->pageFolders) && !empty($page->pageFolders)): ?>
    <div class="files-list">
        <ul>
        <?php foreach ($page->pageFolders->folders as $folder): ?>
            <?php foreach ($folder->documents as $document):
                $file = File::model()->findByPk($document->file);
                if(isset($file)): ?>
                    <li>
                        <a href="<?php echo Documents::getFileUrl($file->id); ?>" target="_blank" class="file <?php echo 'file-'.$file->ext; ?>"><?php echo $document->title; ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif;?>

    <div class="maps-svg mt30">
        <?php $this->widget('application.widgets.mapsWidget'); ?>
    </div>
</div>