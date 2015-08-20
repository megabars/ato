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

            <?php
            $vote = Vote::model()->with(array('answersCount', 'items', 'items.answersCount'))->limit(1)->sorted()->published()->find();
            if ($vote !== null):
                $addClass = '';

            ?>
            <div class="vote iogv-menu">
                <?php $this->widget('application.modules.vote.widgets.vote.VoteWidget', array('data' => $vote)); ?>
            </div>
            <?php endif; ?>

        </div>

        <div class="portal-info">
            <h2><?php echo Yii::t('app', 'Общие сведения')?></h2>
            <?php echo ($mainPage !== null) ? $mainPage->description : ''; ?>
            <?php echo ($mainPage !== null and $mainPage->attachment) ? CHtml::link($mainPage->attachment->origin_name,$this->createUrl('/files/front/download/id/'.$mainPage->attachment->id)) : ''; ?>
        </div>
        <?php if ($this->contact !== null): ?>
        <div class="contact-info clearfix">
            <div class="image">
                <?php if ($this->contact->photo): ?>
                    <img src="<?php echo $this->contact->getMediumUrl('photo'); ?>"/>
                <?php else : ?>
                    <img src="<?php echo $assets ?>/images/no-image.png"/>
                <?php endif; ?>
                <div id="map"></div>
            </div>
            <div class="desc">
                <div class="title"><?php echo Yii::t('app', 'Контакты')?></div>

                <?php if ($this->contact !== null && !empty($this->contact->address)): ?>
                <style type="text/css">
                    .contact-info .image {
                        position: relative;
                    }
                    .contact-info #map {
                        width: 299px;
                        height: 241px;
                    }
                    .contact-info img + #map {
                        position: absolute;
                        left: -9999px;
                        top: 0;
                    }
                </style>

                <script>
                    $(document).ready(function(){
                        $('#show_map').show().on('click', function(){
                            $('#map').css('left', 0);
                        });
                        $('#map').css('height', $('.image img').height());
                    });

                    ymaps.ready(init);

                    function init() {
                        var myMap = new ymaps.Map('map', {
                            center: [49.122853,55.786764],
                            zoom: 6,
                            controls: ['zoomControl']
                        });

                        var button = new ymaps.control.Button({
                            data: {
                                content: "Закрыть карту"
                            },
                            options: {
                                position: {right: 100, top: 10},
                                maxWidth: 200
                            }
                        });
                        button.events.add(['select'], function (e) {
                            if(e.get('type') == 'select') {
                                $('#map').css('left', '-9999px');
                                button.state.set('selected', false);
                            }
                        });
                        myMap.controls.add(button);

                        ymaps.geocode('<?php echo $this->contact->address ?>', {
                            results: 1
                        }).then(function (res) {
                            var firstGeoObject = res.geoObjects.get(0),
                                coords = firstGeoObject.geometry.getCoordinates(),
                                bounds = firstGeoObject.properties.get('boundedBy');

                            myMap.geoObjects.add(firstGeoObject);
                            myMap.setBounds(bounds, {
                                checkZoomRange: true
                            });
                        });
                    }
                </script>

                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Адрес:')?></span> <p><?php echo @$this->contact->address; ?><span id="show_map" class="show-maps"></span></p>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->phone) && is_array($this->contact->phone) && count($this->contact->phone) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Телефон:')?></span>
                        <?php $phoneText = '';
                        foreach($this->contact->phone as $phone)
                            $phoneText .= '<a href="tel:'.$phone->value.'">'.$phone->value.'</a>, ';
                        echo '<p>'.trim($phoneText, ', ').'</p>';
                        ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->fax) && is_array($this->contact->fax) && count($this->contact->fax) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Факс:')?></span>
                        <?php $faxText = '';
                        foreach($this->contact->fax as $fax)
                            $faxText .= '<a href="tel:'.$fax->value.'">'.$fax->value.'</a>, ';
                        echo '<p>'.trim($faxText, ', ').'</p>'; ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->web) && is_array($this->contact->web) && count($this->contact->web) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Дополнительный адрес:')?></span>
                        <?php
                        $webText = '';
                        foreach($this->contact->web as $web)
                            $webText .= '<a href="'.$web->value.'">'.$web->value.'</a>, ';
                        echo '<p>'.trim($webText, ', ').'</p>'; ?>
                </div>
                <?php endif; ?>

                <?php if (isset($this->contact->email) && is_array($this->contact->email) && count($this->contact->email) > 0): ?>
                <div class="row">
                    <span class="label"><?php echo Yii::t('app', 'Электронная почта:')?></span>
                        <?php $emailText = array();
                        foreach($this->contact->email as $email)
                            $emailText[] = '<a href="mailto:'.$email->value.'">'.$email->value.'</a><br/>';

                        echo '<div class="mail-list">'.implode($emailText).'</div>';
                        ?>
                    </p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="clearfix">

        <div class="left-content <?php echo $addClass; ?>">
            <div class="media">
                <?php
                Yii::app()->clientScript->scriptMap=array('jquery-ui.css'=>false);

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

                if (Afisha::model()->published()->count() > 0) {
                    $tabs[Yii::t('app', 'Календарь мероприятий')] = $this->widget('application.modules.afisha.widgets.LatestEventsWidget', array(
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

                if (count($smi) > 0) {
                    $tabs[Yii::t('app', 'Публикации в СМИ')] = $this->renderPartial('application.themes.tomsk.views.main._smi_public', array('data' => $smi), true);
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
    </div>

    <?php $this->widget('application.widgets.mapsWidget'); ?>

    <h2 class="no-padding-bottom"><?php echo Yii::t('app', 'Полезные ресурсы')?></h2>
    <?php $this->widget('application.modules.links.widgets.LinksWidget'); ?>
</div>







