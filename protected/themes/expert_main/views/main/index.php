<?php
/** @var $this Controller */

$assets = $this->getAssetsBase();

$this->pageTitle = 'Главная';
?>


<div class="wrap">

    <div class="iogv-header">

        <div class="right-content">
            <?php
            $addClass = 'full';

            if (NavItems::model()->with('menu')->count("menu.alias = 'right_menu' and t.state = 1 and menu.published = 1") !== 0):
                $addClass = '';
                ?>

                <div class="iogv-menu">
                    <div class="title"><?php echo Yii::t('app', 'Актуальное')?></div>
                    <?php
                    $this->widget('navigation.widgets.menuByAlias', array(
                        'parentId' => $this->navigationItemId,
                        'menu_alias' => 'right_menu',
                        'max_levels' => 0
                    )); ?>
                </div>
            <?php endif; ?>

            <div class="vote">
                <?php $this->widget('application.modules.vote.widgets.vote.VoteWidget'); ?>
            </div>

            <?php if ($mainPage !== null && isset($mainPage->info_thread) && $mainPage->info_thread == 1): ?>
                <?php $addClass = ''; ?>
                <div class="infopotok">
                    <!--Begin OpenGov Infostream-widget code-->
                    <script src="http://bigovernment.ru/twinvest/api/widget/infopotok/script.js"
                            type="text/javascript"></script>
                    <div id="bg-infopotok-widget-container" data-width="220" data-height="425"><img
                            src="http://bigovernment.ru/twinvest/api/widget/loading.gif"/></div>
                    <!--End of OpenGov Infostream-widget code-->
                </div>
            <?php endif; ?>
        </div>

        <div class="portal-info">
            <h2><?php echo Yii::t('app', 'Общие сведения')?></h2>
            <?php echo ($mainPage !== null) ? $mainPage->description : ''; ?>
        </div>
    </div>

    <div class="clearfix">

        <div class="left-content <?php echo $addClass; ?>">
            <div class="media">
                <?php
                Yii::app()->clientScript->scriptMap=array('jquery-ui.css'=>false);

                // переключатель с инфой
                $tabs = array();
                if ($news->itemCount > 0){
                    $tabs[Yii::t('app', 'Новости')] = $this->widget('zii.widgets.CListView', array(
                            'dataProvider'=> $news,
                            'itemsTagName'=>'ul',
                            'htmlOptions'=>array(
                                'class'=>'last-news'
                            ),
                            'itemView'=>'application.themes.tomsk.views.main._news',
                        ), true).'<div class="foot clearfix"><a href="" class="fl">'.Yii::t('app', 'Подписаться').'</a><a href="/news/front" class="fr">'.Yii::t('app', 'Все новости').'</a></div>';
                }

                if (Afisha::model()->count() > 0) {
                    $tabs[Yii::t('app', 'Календарь заседаний')] = $this->widget('application.modules.afisha.widgets.LatestEventsWidget', array(
                        'name' => Yii::t('app', 'Календарь заседаний'),
                        'type'=>'month',
                        'date'=>date('d.m.Y')), true);
                }

                if (PhotoGallery::model()->published()->count() > 0) {
                    $tabs[Yii::t('app', 'Фото')] = $this->widget('galleryWidget', array(
                        'alias'=> 'main',
                        'itemView'=>'application.themes.tomsk.views.main._gallery_folder',
                        'galleryModel'=> new PhotoGallery(),
                    ), true);
                }

                $this->widget('zii.widgets.jui.CJuiTabs',array(
                    'tabs'=> $tabs,
                    // additional javascript options for the tabs plugin
                    'options'=>array(
                        'collapsible'=>true,
                    )));
                ?>
            </div>
        </div>
    </div>

    <div class="block-link-custom">
        <?php $this->widget('navigation.widgets.servicesWidget'); ?>
<!--        <ul>-->
<!--            <li>-->
<!--                <a class="item" href="/experts/front/index">-->
<!--                    <span class="image">-->
<!--                        <img src="--><?php //echo $assets; ?><!--/images/icon/1.png"/>-->
<!--                    </span>-->
<!--                    <span class="label">База данных экспертов</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="item" href="">-->
<!--                    <span class="image">-->
<!--                        <img src="--><?php //echo $assets; ?><!--/images/icon/2.png"/>-->
<!--                    </span>-->
<!--                    <span class="label">Экспертное обсуждение</span>-->
<!--                </a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a class="item fancy" href="--><?php //echo $this->createUrl('/feedback/front/index'); ?><!--">-->
<!--                <span class="image">-->
<!--                    <img src="--><?php //echo $assets; ?><!--/images/icon/3.png"/>-->
<!--                </span>-->
<!--                    <span class="label">Задать вопрос</span>-->
<!--                </a>-->
<!--            </li>-->
<!--        </ul>-->
    </div>

    <?php if(LinksGroup::model()->findByAttributes(array('alias' => 'main'))):?>
        <h2 class="no-padding-bottom"><?php echo Yii::t('app', 'Полезные ресурсы')?></h2>
        <?php $this->widget('application.modules.links.widgets.LinksWidget'); ?>
    <?php endif; ?>
</div>







