<div class="item yandex-metrika">
    <div class="head">
        Статистика
        <div class="dropdown">
            <div class="dropdown-trigger"></div>
            <div class="dropdown-list right">
                <ul>
                    <li><a href="#" data-begin="<?php echo strtotime('-1 day'); ?>" data-end="<?php echo strtotime('+1 day'); ?>">Показать за день</a></li>
                    <li><a href="#" data-begin="<?php echo strtotime('-1 month'); ?>">Показать за месяц</a></li>
                    <li><a href="#" data-begin="<?php echo strtotime('-1 year'); ?>">Показать за год</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="body metrika loader">
        <canvas id="metrika" width="340" height="170"></canvas>
    </div>

    <div style="margin: 5px">
        <!-- Yandex.Metrika informer -->
        <a href="https://metrika.yandex.ru/stat/?id=28522211&amp;from=informer"
        target="_blank" rel="nofollow" class="yamBth"><img src="//bs.yandex.ru/informer/28522211/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                       style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:28522211,lang:'ru'});return false}catch(e){}"/></a>
        <!-- /Yandex.Metrika informer -->
    </div>
</div>

<script>
    function getData($begin,$end){
        $.getJSON('/admin/main/metrika', {'beginDay':$begin,'endDay':$end})
            .success(function (data) {
                console.log(data)
                $('.line-legend').remove();
                $('.metrika').removeClass('loader');
                var ctx = $("#metrika").get(0).getContext("2d");
                if(window.myLine){
                    window.myLine.destroy();
                }
                var myLineChart = new Chart(ctx).Line(data, {
                    scaleFontColor: "#a9b2bd",
                    scaleFontSize: 11,
                    pointDotRadius : 3,
                    pointHitDetectionRadius : 4
                });
                window.myLine = myLineChart;

                var legend = myLineChart.generateLegend();
                $('.metrika').append(legend);
            });
    }
    getData(<?php echo strtotime('-6 day'); ?>);

    $('.yandex-metrika a').not('.yamBth').on('click',function(e){
        e.preventDefault();
        getData($(this).data('begin'),$(this).data('end'));
    });
</script>