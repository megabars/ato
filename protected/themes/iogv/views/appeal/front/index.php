<?php
/**
 * @var $this Controller
 * @var $content StaticPage->description
 */
//$this->pageTitle = 'Обращения граждан';
$this->breadcrumbs = array(
    'Обращения граждан',
    'Общая информация'
);
?>

<div class="wrap">
    <div class="clearfix">

        <?php $this->renderPartial('_menu') ?>

        <div class="left-content">

            <h2><?php echo $this->pageTitle; ?></h2>
            <h3>Общая информация</h3>

            <div class="portal-info static-page-content clearfix">
                <?php if ($page->image !== null): ?>
                    <div class="image">
                        <a href="<?php echo $page->getImageUrl('image_id') ?>" class="fancybox">
                            <img src="<?php echo $page->getMediumUrl('image_id');  ?>">
                        </a>
                    </div>
                <?php endif; ?>
                <?php echo $page->description; ?>
            </div>

            <?php if ($page->attachment !== null): ?>
                <div class="files mt15">
                    <a href="<?php echo $this->createUrl('/files/front/download', array('id' => $page->attachment->id)); ?>"
                       title="<?php echo $page->attachment->origin_name?>"
                       target="_blank"
                       class="file file-<?php echo $page->attachment->ext?>"><?php echo $page->attachment->origin_name ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($page->pageNews !== null && $page->pageNews->news !== null && count($page->pageNews->news) > 0): ?>
                <div class="media">
                    <?php

                    $tabs = array();

                    $tabs['Новости'] = $this->widget('application.modules.news.widgets.LatestPageNewsWidget', array('alias' => $page->pageNews->alias,),true);

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

            <?php if($page->pageVideo) : ?>
                <div class="page-video">
                    <video controls="controls" preload="metadata">
                        <source src="<?php echo BaseActiveRecord::getFileUrl($page->pageVideo->mp4); ?>" type='video/mp4;'>
                        <source src="<?php echo BaseActiveRecord::getFileUrl($page->pageVideo->ogv); ?>" type='video/ogg; codecs="theora, vorbis"'>
                        <source src="<?php echo BaseActiveRecord::getFileUrl($page->pageVideo->webm); ?>" type='video/webm; codecs="vp8, vorbis"'>
                    </video>
                </div>
            <?php endif; ?>

            <?php if (isset($page->pageGallery) && $page->pageGallery !== null && count($page->pageGallery->photoGalleryPhotos)): ?>
                <div class="media">
                    <?php

                    $tabs = array();

                    $tabs['Фото'] = $this->widget('galleryWidget', array(
                        'galleryModel' => $page->pageGallery,
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

            <?php if (isset($page->url) && !empty($page->url->meta_keywods)):?>
                <div class="hash-tag">
                    Ключевые слова: <span><?php echo $page->url->meta_keywods; ?></span>
                </div>
            <?php endif; ?>

            <div class="hr"></div>

            <div class="clearfix">
                <?php if ($page->social == 1): ?>
                    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
                <?php endif; ?>

                <div class="page-date">
                    <b>Опубликовано:</b><?php echo $page->date; ?>
                    <span class="line">|</span>
                    <b>Обновлено:</b><?php echo $page->modify; ?>
                </div>

            </div>

        </div>

    </div>
    <?php if ($page->pageLinks !== null)
        $this->widget('application.modules.links.widgets.LinksWidget', array('alias' => $page->pageLinks->alias));
    ?>


        </div>
    </div>
</div>


