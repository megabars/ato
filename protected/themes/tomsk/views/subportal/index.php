<?php
/** @var $this Controller */

$assets = $this->getAssetsBase();

$this->pageTitle = 'Главная';
?>


<div class="wrap">
    <div class="clearfix">
        <div class="portal-info">
            <h2>Общие сведения</h2>

            <div class="image">
                <img src="<?php echo $assets; ?>/images/portal.jpg"/>
            </div>
            <div class="desc">
                <p>«Отныне ни одно стратегическое решение областной исполнительной власти не получит развития без обсуждения на экспертных советах. Только ради этого мы меняли философию власти, основанную на открытости и готовности слышать.</p>
                <p>Задача экспертных советов – стать и коллективным замом, и общественным радио – каналом, по которому общество и бизнес может транслировать информацию власти.</p>
                <p>Многочисленное представительство в экспертных советах получили наши производственники, в том числе руководители предприятий малого бизнеса. Таких 43 человека. Наиболее широко представлен наш научно-образовательный комплекс – 48 человек, все шесть университетов. 15 наших экспертов работают в ТГУ, 9 – в Томском политехническом, 7 представляют академическую и отраслевую науку.</p>
                <p>В советы вошли руководители 17 общественных и профессиональных объединений, 8 врачей, 6 представителей финансового сектора. Есть в ваших рядах журналисты, деятели культуры и спортсмены – люди, благодаря которым о Томской области знают далеко за её пределами».</p>
                <p>Контролирующий орган: <a href="">Департамент экспертно-аналитической работы</a></p>
            </div>
        </div>
    </div>

    <div class="media">
        <?php
        Yii::app()->clientScript->scriptMap=array('jquery-ui.css'=>false);
        // переключатель с инфой
        $this->widget('zii.widgets.jui.CJuiTabs',array(
            'tabs'=> array(
                'Новости' => $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=> $news,
                        'itemsTagName'=>'ul',
                        'htmlOptions'=>array(
                            'class'=>'last-news last-news-full'
                        ),
                        'itemView'=>'../main/_news',
                    ), true).'<div class="foot clearfix"><a href="" class="fl">Подписаться</a><a href="/news/front" class="fr">Все новости</a></div>',

                'Сюжеты' => 'Тут по идее будет вставляться видео или канал youtube',

                'Фото' => $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=> $gallery,
                    'itemsTagName'=>'ul',
                    'itemView'=>'../main/_gallery',
                ), true),

                'Стенограммы' => '',
                'Пресс-релизы' => ''
            ),
            // additional javascript options for the tabs plugin
            'options'=>array(
                'collapsible'=>true,
            ),
        ));
        ?>
    </div>

    <div class="block-link">
        <ul>
            <li>
                <a class="item" href="">
                    <span class="image">
                        <img src="<?php echo $assets; ?>/images/icon/1.png"/>
                    </span>
                    <span class="label">База данных экспертов</span>
                </a>
            </li>
            <li>
                <a class="item" href="">
                    <span class="image">
                        <img src="<?php echo $assets; ?>/images/icon/2.png"/>
                    </span>
                    <span class="label">Экспертное обсуждение</span>
                </a>
            </li>
            <li>
                <a class="item" href="">
                <span class="image">
                    <img src="<?php echo $assets; ?>/images/icon/3.png"/>
                </span>
                    <span class="label">Задать вопрос</span>
                </a>
            </li>
        </ul>
    </div>

    <?php
    // Календарь мероприятий
    $this->renderPartial('_calendar', array('events' => $events));
    ?>

    <h2 class="no-padding-bottom">Полезные ресурсы</h2>
    <?php $this->widget('application.modules.links.widgets.LinksWidget'); ?>
</div>







