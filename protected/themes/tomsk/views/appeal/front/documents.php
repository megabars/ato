<?php
/**
 * @var $this Controller
 */
$this->pageTitle = 'Нормативные документы';

$this->breadcrumbs = array(
    'Открытый Регион',
    'Обращения',
    $this->pageTitle
);
?>

<div class="wrap">
    <h2>Обращения граждан</h2>
    <h3><?php echo $this->pageTitle; ?></h3>

    <div class="clearfix">
        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">
            <?php if (isset($pageFolders) && !empty($pageFolders)): ?>
                <div class="collapses mt30">
                    <?php foreach ($pageFolders->folders as $folder): ?>
                        <div class="item">
                            <div class="title">
                                <div class="name"><?php echo $folder->title; ?></div>
                                <div class="toggle"></div>
                            </div>
                            <div class="desc">
                                <div class="files">
                                    <?php if (isset($folder->documents) && !empty($folder->documents)): ?>
                                    <?php foreach ($folder->documents as $document):
                                        $file = File::model()->findByPk($document->file);
                                        ?>
                                        <div class="item">
                                            <a href="<?php echo Documents::getFileUrl($file->id); ?>" class="file <?php echo 'file-'.$file->ext ?>"><?php echo $document->title; ?></a>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>В этой папке нет документов</p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Нет документов для отображения</p>
            <?php endif;?>
        </div>
    </div>
</div>