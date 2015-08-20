<?php
/** @var $this Controller */

$assets = $this->getAssetsBase();

$this->pageTitle = 'Главная';

?>


<div class="wrap">
    <div class="clearfix invalid-hide">
        <div class="right-content">
            <?php
            // Губернатор
            $this->widget('application.modules.gubernator.widgets.GubernatorWidget'); ?>
        </div>
        <div class="left-content">
            <?php
            // события региона
            $this->renderPartial('_event', array('events' => $events));
            ?>
        </div>
    </div>

    <div class="media">
        <?php
        Yii::app()->clientScript->scriptMap=array('jquery-ui.css'=>false);
        // переключатель с инфой
        $this->widget('zii.widgets.jui.CJuiTabs',array(
            'tabs'=> array(
                Yii::t('app', 'Новости') => $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=> $news,
                        'itemsTagName'=>'ul',
                        'htmlOptions'=>array(
                            'class'=>'last-news last-news-full'
                        ),
                        'itemView'=>'_news',
                        ), true).'<div class="foot clearfix"><a href="'.$this->createUrl('/news/front/subscribe').'" class="fancy">Подписаться</a><a href="/news/front" class="fr">Все новости</a></div>',

//                'Сюжеты' => 'Тут по идее будет вставляться видео или канал youtube',

                Yii::t('app', 'Фото') => $this->widget('galleryWidget', array(
                    'alias'=> 'main',
                    'itemView'=>'application.themes.tomsk.views.main._gallery_folder',
                    'galleryModel'=> new PhotoGallery(),
                    ), true),

//                Yii::t('app', 'Стенограммы') => $this->widget('zii.widgets.CListView', array(
//                    'dataProvider'=> $verbReports,
//                    'itemsTagName'=>'ul',
//                    'htmlOptions'=>array(
//                        'class'=>'last-news last-news-full'
//                    ),
//                    'itemView'=>'_verb',
//                    ), true),
//                'Пресс-релизы' => '',
                Yii::t('app', 'Календарь мероприятий') => $this->widget('application.modules.afisha.widgets.LatestEventsWidget', array('type'=>'month','date'=>date('d.m.Y')), true),

                Yii::t('app', 'Томская область в СМИ') => $this->renderPartial('_smi_public', array('data' => $smi), true),


            ),
            // additional javascript options for the tabs plugin
            'options'=>array(
                'collapsible'=>true,
            ),
            'htmlOptions'=>array(
                'class'=>'media-main'
            ),
        ));
        ?>
    </div>

    <div class="online-service">
        <h2>Онлайн сервисы</h2>
        <ul class="clearfix">
            <li>
                <a  target="_blank" href="<?php echo $this->createUrl('/appeal/front');?>" class="item">
                    <img src="<?php echo $assets; ?>/images/online/1.png"/>
                    <div class="txt">Электронная приемная</div>
                </a>
            </li>
            <li>
                <a target="_blank" href="<?php echo $this->createUrl('/antiCorruption/front');?>" class="item">
                    <img src="<?php echo $assets; ?>/images/online/2.png"/>
                    <div class="txt">Противодействие коррупции</div>
                </a>
            </li>
            <li>
                <a target="_blank" href="<?php echo $this->createUrl('/opendata/front');?>" class="item">
                    <img src="<?php echo $assets; ?>/images/online/3.png"/>
                    <div class="txt">Открытые данные</div>
                </a>
            </li>
            <li>
                <a target="_blank" href="http://open.findep.org" class="item" target="_blank">
                    <img src="<?php echo $assets; ?>/images/online/4.png"/>
                    <div class="txt">Открытый бюджет</div>
                </a>
            </li>
            <li>
                <a target="_blank" href="<?php echo $this->createUrl('/openregion/purchase?menuItem=1609');?>" class="item">
                    <img src="<?php echo $assets; ?>/images/online/5.png"/>
                    <div class="txt">Госзакупки</div>
                </a>
            </li>
            <li>
                <a target="_blank" href="<?php echo $this->createUrl('/vote/front');?>" class="item">
                    <img src="<?php echo $assets; ?>/images/online/6.png"/>
                    <div class="txt">Опрос</div>
                </a>
            </li>
        </ul>
    </div>

    <?php $this->widget('application.widgets.mapsWidget'); ?>

    <?php $this->widget('application.modules.links.widgets.LinksWidget'); ?>
</div>

<?php //$this->renderPartial('application.themes.tomsk.views.layouts._link'); ?>
