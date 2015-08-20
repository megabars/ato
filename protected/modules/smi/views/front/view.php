<?php
/**
 * @var $this Controller
 * @var $record Smi
 */

$this->pageTitle = $this->portalId == 1 ? 'Томская область в СМИ' : 'Публикации СМИ';

$this->breadcrumbs = array(
    'Пресс-Центр',
    $this->pageTitle => $this->createUrl('/smi/front/index'),
    $record->title,
);
?>

<div class="wrap">
    <h2><?php echo $record->title; ?></h2>
    <p class="date"><?php echo Rudate::date($record->date); ?></p>
<!--    <div class="text_body clearfix">-->
<!--        --><?php //if($record->getMediumUrl('photo')): ?>
<!--        <div class="image">-->
<!--            <img src="--><?php //echo $record->getMediumUrl('photo'); ?><!--" />-->
<!--            <span>--><?php //echo $record->photo_title; ?><!--</span>-->
<!--        </div>-->
<!--        --><?php //endif; ?>
<!--        <div class="text">-->
<!--            --><?php //echo $record->description; ?>
<!--            --><?php //if ($record->source) : ?>
<!--                <div>источник: --><?php //echo $record->source_link ? CHtml::link($record->source, $record->source_link) : $record->source; ?><!--</div>-->
<!--            --><?php //endif; ?>
<!--            --><?php //if ($record->keywords): ?>
<!--                <div class="keywords">ключевые слова:-->
<!---->
<!--                --><?php //echo $record->getKeywordsAsLink('/smi/front/index'); ?>
<!--                </div>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--    </div>-->

    <div class="text_body clearfix">
        <?php if($record->getMediumUrl('photo')): ?>
            <div class="image">
                <img src="<?php echo $record->getMediumUrl('photo'); ?>" />
                <span><?php echo $record->photo_title; ?></span>
            </div>
        <?php endif; ?>

        <div class="text">
            <?php echo $record->description; ?>
            <?php
            if ($record->url !== null && !empty($record->url->meta_keywods))
                echo '<div class="hash-tag">'. Yii::t('app', 'Ключевые слова:') .' <span>'.$record->url->meta_keywods.'</span></div>';
            ?>

            <?php if (isset($record->pageFolders) && !empty($record->pageFolders)): ?>
                <div class="collapses mt30">
                    <?php foreach ($record->pageFolders->folders as $folder): ?>
                        <div class="item">
                            <div class="title">
                                <div class="name"><?php echo $folder->title; ?></div>
                                <div class="toggle"></div>
                            </div>
                            <div class="desc">
                                <div class="files">
                                    <?php
                                    foreach ($folder->documents as $document):
                                        $file = File::model()->findByPk($document->file);
                                        if(isset($file)):
                                            ?>
                                            <div class="item">
                                                <a href="<?php echo Documents::getFileUrl($file->id); ?>" class="file <?php echo 'file-'.$file->ext ?>"><?php echo $document->title; ?></a>
                                            </div>
                                        <?php endif;
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif;?>

            <?php if($record->pageVideo) : ?>
                <div class="page-video">
                    <video controls="controls" preload="metadata">
                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->pageVideo->mp4); ?>" type='video/mp4;'>
                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->pageVideo->ogv); ?>" type='video/ogg; codecs="theora, vorbis"'>
                        <source src="<?php echo BaseActiveRecord::getFileUrl($record->pageVideo->webm); ?>" type='video/webm; codecs="vp8, vorbis"'>
                    </video>
                </div>
            <?php endif; ?>

            <?php if (isset($record->pageGallery) && $record->pageGallery !== null && count($record->pageGallery->photoGalleryPhotos)): ?>
                <div class="media">
                    <?php

                    $tabs = array();

                    $tabs[Yii::t('app', 'Фото')] = $this->widget('galleryWidget', array(
                        'galleryModel' => $record->pageGallery,
                        'itemView' => 'application.themes.tomsk.views.main._gallerySimple',
                        'htmlOptions' => array(
                            'class' => 'photogallery-wraper'
                        )
                    ), true);

                    // переключатель с инфой
                    $this->widget('zii.widgets.jui.CJuiTabs', array(
                        'tabs' => $tabs,
                        'options' => array(
                            'collapsible' => true,
                        ),
                    ));
                    ?>
                </div>
            <?php endif; ?>

            <div class="clearfix">
                <div class="hr"></div>

                <div class="page-date">
                    <b><?php echo Yii::t('app', 'Опубликовано:'); ?></b><?php echo $record->date; ?>
                </div>
                <?php if ($record->social == 1): ?>
                    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if ($record->pageLinks !== null)
        $this->widget('application.modules.links.widgets.LinksWidget', array('alias' => $record->pageLinks->alias));
    ?>


</div>

