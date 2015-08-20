<?php
/**
 * @var $this Controller
 * @var $model Documents
 */

$this->pageTitle = 'Нормативно-правовые акты';

$this->breadcrumbs = array(
    'Документы'=>'/documents',
    'Нормативно-правовые акты' => $this->createUrl('/documents/front/index'),
    $model->title,
);
?>

<div class="wrap">

    <div class="clearfix">
        <div class="right-content">
            <div class="docs-info">
                <?php if(isset($model->public)): ?>
                <div class="title">
                    <b>Официальная публикация распоряжения:</b>
                    <div>№<?php echo $model->number; ?></div>
                </div>
                <?php endif; ?>

                <div class="date-docs">
                    <b>Дата утверждения:</b>
                    <?php echo date('d.m.Y H:i:s',$model->date_real); ?>
                    <b>Дата публикации:</b>
                    <?php echo date('d.m.Y H:i:s',$model->date_public); ?>
                </div>

                <?php if(isset($model->pdf) || isset($model->doc) || isset($model->zip)): ?>
                <div class="link-docs">
                    <b>Скачать документ:</b>
                    <?php if(isset($model->pdf)): ?>
                    <div><a href="<?php echo $model->getFileUrl($model->pdf); ?>"><?php echo File::model()->findByPk($model->pdf)->ext; ?> (<?php echo File::getFileSize($model->pdf, 'Mb'); ?>)</a></div>
                    <?php endif; ?>
                    <?php if(isset($model->doc)): ?>
                    <div><a href="<?php echo $model->getFileUrl($model->doc); ?>"><?php echo File::model()->findByPk($model->doc)->ext; ?> (<?php echo File::getFileSize($model->doc, 'Mb'); ?>)</a></div>
                    <?php endif; ?>
                    <?php if(isset($model->zip)): ?>
                    <div><a href="<?php echo $model->getFileUrl($model->zip); ?>"><?php echo File::model()->findByPk($model->zip)->ext; ?> (<?php echo File::getFileSize($model->zip, 'Mb'); ?>)</a></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="left-content">
            <h2><?php echo $model->title; ?></h2>
            <div class="custom-content">
                <p><b><?php echo $model->preview; ?></b></p>
                <?php echo $model->description; ?>
            </div>
        </div>
    </div>
</div>