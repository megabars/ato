<?php
/**
 * @var $regions StaticPage[]
 */
?>

<h2 class="maps-widgets-header">Интерактивная карта Томской области</h2>

<div class="maps-svg">
    <div class="map clearfix">
        <div class="svg">
            <div class="svg-content">
                <svg id="svg" version="1.2" baseProfile="tiny" xmlns="http://www.w3.org/2000/svg"
                x="0px" y="0px" width="100%" height="300px" viewBox="0 0 630 452" xml:space="preserve">

                    <filter id="dropshadow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
                        <feOffset dx="1" dy="1" result="offsetblur"/>
                        <feComponentTransfer>
                            <feFuncA type="linear" slope="0.4"/>
                        </feComponentTransfer>
                        <feMerge>
                            <feMergeNode/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>

                    <?php foreach($regions as $region) { ?>
                        <?php if($region->mapItem->is_city) continue; ?>
                        <path
                            data-id="<?php echo $region->mapItem->id; ?>"
                            data-name="<?php echo $region->mapItem->name; ?>"
                            data-url="/<?php echo ($peopleUrl)?'people/front/view/id/'.@(int)$people[@$region->mapItem->id]->id.'/from/maps':@UrlManager::model()->allPortalsCriteria()->findByPk($region->url_id)->url; ?>"
                            data-head="<?php echo $region->mapItem->head; ?>"
                            data-area="<?php echo $region->mapItem->area; ?>"
                            data-people="<?php echo $region->mapItem->people; ?>"
                            data-site="<?php echo $region->mapItem->site; ?>"
                            d="<?php echo $region->mapItem->path; ?>"/>
                    <?php } ?>

                    <?php foreach($regions as $region) { ?>
                        <?php if(!$region->mapItem->is_city) continue; ?>
                        <path class="city"
                              data-type="city"
                              data-id="<?php echo $region->mapItem->id; ?>"
                              data-name="<?php echo $region->mapItem->name; ?>"
                              data-url="/<?php echo ($peopleUrl)?'people/front/view/id/'.@(int)$people[@$region->mapItem->id]->id.'/from/maps':@UrlManager::model()->allPortalsCriteria()->findByPk($region->url_id)->url; ?>"
                              data-head="<?php echo $region->mapItem->head; ?>"
                              data-area="<?php echo $region->mapItem->area; ?>"
                              data-people="<?php echo $region->mapItem->people; ?>"
                              data-site="<?php echo $region->mapItem->site; ?>"
                              d="<?php echo $region->mapItem->path; ?>" style="filter: url(#dropshadow)"/>
                    <?php } ?>

                    <text class="label" x="90" y="50">Стрежевой</text>
                    <text class="label" x="160" y="310">Кедровый</text>
                    <text class="label" x="435" y="365">Северск</text>
                    <text class="label" font-size="17" x="390" y="404">Томск</text>
                </svg>
                <div class="svg-popup animated flipInY">
                    <a href="" class="name"></a>
                    <div class="big-people" id="popup-head-wrap">
                        <div class="label">Глава района</div>
                        <span class="fio"></span>
                    </div>
                    <div class="info">
                        <div id="popup-area-wrap">Территория: <b><span id="popup-area"></span> тыс. км2</b></div>
                        <div id="popup-people-wrap">Население: <b><span id="popup-people"></span> тыс.чел.</b></div>
                        <div id="popup-site-wrap">Сайт: <a href="http://tomsk.gov.ru" target="_blank"><span id="popup-site"></span></a></div>
                    </div>
                    <div class="shadow"></div>
                </div>
            </div>
        </div>

        <div class="menu">
            <ul>
                <?php foreach($regions as $region) { ?>
                    <li>
                        <a href="/<?php echo ($peopleUrl)?'people/front/view/id/'.@(int)$people[@$region->mapItem->id]->id.'/from/maps':@$region->url->url; ?>"
                            <?php if($region->mapItem->is_city) echo 'data-type="city"'; ?>
                            data-x="<?php echo $region->mapItem->pos_x; ?>"
                            data-y="<?php echo $region->mapItem->pos_y; ?>"
                            data-id="<?php echo $region->mapItem->id; ?>"
                            data-name="<?php echo $region->mapItem->name; ?>"
                            data-url="/<?php echo ($peopleUrl)?'people/front/view/id/'.@(int)$people[@$region->mapItem->id]->id.'/from/maps':@$region->url->url; ?>"
                            data-head="<?php echo $region->mapItem->head; ?>"
                            data-area="<?php echo $region->mapItem->area; ?>"
                            data-people="<?php echo $region->mapItem->people; ?>"
                            data-site="<?php echo $region->mapItem->site; ?>">
                            <?php echo $region->mapItem->name; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <script>
        $(document).click(function(e){
            if($(e.target).closest('.svg-content, .menu').length <= 0) {
                $('.maps-svg .svg-popup').hide();
            }
        });
        function showPopup($posX,$posY,element){
            var popup = $('.maps-svg .svg-popup');
            var headType = (element.data('type') == 'city') ? 'Мэр' : 'Глава района';

            popup.find('.name').attr('href', element.data('url')).html(element.data('name'));
            popup.find('.big-people .label').html(headType);

            if(element.data('head') != '') {
                popup.find('#popup-head-wrap').show();
                popup.find('.fio').html(element.data('head'));
            } else {
                popup.find('#popup-head-wrap').hide();
            }

            if(element.data('area') != '') {
                popup.find('#popup-area-wrap').show();
                popup.find('#popup-area').html(element.data('area'));
            } else {
                popup.find('#popup-area-wrap').hide();
            }

            if(element.data('people') != '') {
                popup.find('#popup-people-wrap').show();
                popup.find('#popup-people').html(element.data('people'));
            } else {
                popup.find('#popup-people-wrap').hide();
            }

            if(element.data('site') != '') {
                popup.find('#popup-site-wrap').show();
                popup.find('#popup-site').html(element.data('site'));
                popup.find('#popup-site-wrap a').attr('href', element.data('site'));
            } else {
                popup.find('#popup-site-wrap').hide();
            }

            popup.css({
                'top':$posY - popup.outerHeight() - 30,
                'left':$posX - 30
            });
            popup.show();
        };


        $('.menu a').on('mouseenter', function(e) {
            $('.maps-svg path[data-id="' + $(this).attr('data-id') + '"]').click();
        });

        $('.maps-svg path').on('click',function(e){
            $(this).attr('class','opened').siblings('path').attr('class','')
            $('.maps-svg .svg-popup').hide();
            var offset = $('#svg').offset();

            var bbox = $(this).context.getBoundingClientRect();

            var x = bbox.left + (bbox.width / 2) - offset.left;
            var y = bbox.top + (bbox.height / 2) - offset.top + $(window).scrollTop();

            showPopup(x, y, $(this));
        });

        var enter = function(){
            var id = $(this).data('id');
            var elem = $('.maps-svg path[data-id="'+id+'"]');
            elem.attr('class','active');
        }
        var leave = function(){
            var id = $(this).data('id');
            var elem = $('.maps-svg path[data-id="'+id+'"]');
            elem.attr('class','');
        }

        $('.maps-svg .menu a').mouseenter(enter).mouseleave(leave);
    </script>
</div>