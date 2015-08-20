<?php
/**
 * @var $this Controller
 * @var $page Page
 */

$addClass = 'full';

if ($this->navigationItemId !== null AND
    NavItems::model()->with('menu')->countByAttributes(array("parent_id" => $this->navigationItemId)) !== 0){

    $addClass = '';

}

?>
<div class="wrap">
<div class="clearfix">

<div class="right-content">
    <?php if ($this->navigationItemId !== null): ?>
        <div class="right-menu">
            <?php
            $this->widget('navigation.widgets.menuByAlias', array(
                'parentId' => $this->navigationItemId,
                'menu_alias' => 'main_menu',
                'max_levels' => 0
            ));
            //                $addClass = '';
            ?>
        </div>
    <?php endif; ?>

    <?php if ($this->navigationItemId !== null): ?>
        <div class="right-menu">
            <?php
            $this->widget('navigation.widgets.menuByAlias', array(
                'parentId' => $this->navigationItemId,
                'menu_alias' => 'services',
                'max_levels' => 0
            ));
            //                    $addClass = '';
            ?>
        </div>
    <?php endif; ?>

    <?php if (count($page->executives) > 0): ?>
        <div class="right-menu authorities-menu">
            <div class="title">
                <?php echo (count($page->executives) == 1) ?  Yii::t('app', 'Орган власти') :  Yii::t('app', 'Органы власти') ?>
            </div>
            <ul>
                <?php
                $addClass = '';

                foreach ($page->executives as $ex)
                    if(!empty($ex->executive))
                        echo "<li><a href='{$ex->url}' target='_blank'>{$ex->executive->name}</a></li>";
                ?>
            </ul>
        </div>
    <?php endif;?>

    <?php if (isset($page->pageFacts) && !empty($page->pageFacts)): ?>
        <div class="right-slide">
            <div class="title"><?php echo Yii::t('app', 'Факты'); ?></div>
            <div class="slide">
                <ul>
                    <?php
                    $addClass = '';
                    foreach ($page->pageFacts as $fact): ?>
                        <li>
                            <div class="txt">
                                <?php echo $fact->text; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a class="next" href="#"><?php echo Yii::t('app', 'еще факт'); ?></a>

            </div>
        </div>
    <?php endif;?>

    <?php if (isset($page->info_thread) && $page->info_thread == 1): ?>
        <div class="infopotok">
            <!--Begin OpenGov Infostream-widget code-->
            <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js"
                    type="text/javascript"></script>
            <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img
                    src="http://bigovernment.ru/twinvest/api/widget/loading.gif"/></div>
            <!--End of OpenGov Infostream-widget code-->
        </div>
        <?php
        $addClass = '';
    endif; ?>
</div>

<div class="left-content <?php echo $addClass; ?>">
    <h2 class="title-page"><?php echo $page->title; ?></h2>


    <div class="portal-info static-page-content clearfix">
        <?php if ($page->image !== null): ?>
            <div class="image">
                <a href="<?php echo $page->getImageUrl('image_id') ?>" class="fancybox">
                    <img src="<?php echo $page->getMediumUrl('image_id');  ?>">
                </a>
            </div>
        <?php endif; ?>
        <div class="ckeditor ckeditor-invalid"><?php echo $page->description; ?></div>
    </div>

    <?php if ($page->attachment !== null): ?>
        <div class="files mt15" style="display: inline-block; width: 100%;">
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

            $tabs[Yii::t('app', 'Новости')] = $this->widget('application.modules.news.widgets.LatestPageNewsWidget', array('alias' => $page->pageNews->alias,),true);

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

    <?php if (isset($page->pageFolders) && !empty($page->pageFolders)): ?>
        <div class="collapses mt30">
            <?php foreach ($page->pageFolders->folders as $folder): ?>
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

            $tabs[Yii::t('app', 'Фото')] = $this->widget('galleryWidget', array(
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
            <?php echo Yii::t('app', 'Ключевые слова:'); ?> <span><?php echo $page->url->meta_keywods; ?></span>
        </div>
    <?php endif; ?>

    <div class="hr"></div>

    <div class="clearfix">
        <?php if ($page->social == 1): ?>
            <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
        <?php endif; ?>

        <div class="page-date">
            <b><?php echo Yii::t('app', 'Опубликовано:'); ?></b><?php echo $page->date; ?>
            <span class="line">|</span>
            <b><?php echo Yii::t('app', 'Обновлено:'); ?></b><?php echo $page->modify; ?>
        </div>

    </div>

</div>

</div>
<?php if ($page->pageLinks !== null)
    $this->widget('application.modules.links.widgets.LinksWidget', array('alias' => $page->pageLinks->alias));
?>
</div>