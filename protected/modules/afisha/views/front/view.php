<?php
/**
 * @var $this Controller
 * @var $record Afisha
 * @var $time string
 */

$this->pageTitle = 'Календарь мероприятий - '.$record->title;

$this->breadcrumbs = array(
    'Пресс-Центр',
    'Календарь мероприятий' => $this->createUrl('/afisha/front/index'),
    $record->title
);
?>

<div class="wrap inside-media ckeditor">
    <div class="contact-info type2 clearfix">
        <div class="image">
            <?php if(isset($record->photo)): ?>
            <img src="<?php echo $record->getMediumUrl('photo'); ?>"/>
            <?php endif; ?>
            <div id="map">

            </div>
        </div>
        <div class="desc">
            <div class="title"><?php echo $record->title; ?></div>
            <?php if(!empty($record->place)): ?>
            <div class="row">
                <span class="label">Место проведения:</span>
                <?php echo $record->place; ?>
                <span id="show_map" class="show-maps" style="display: none"></span>
            </div>
            <?php endif; ?>

            <div class="row">
                <span class="label">Дата и время начала:</span> <?php echo Rudate::date(date((date('H', $record->date)=='00')?'d F Y':'d F Y, H:i', $record->date)); ?>
            </div>

            <?php if(!empty($record->duration)): ?>
                <?php if(empty($time)): ?>
                <div class="row">
                    <span class="label">Дата и время окончания:</span> <?php echo Rudate::date(date((date('H', $record->duration)=='00')?'d F Y':'d F Y, H:i', $record->duration)); ?>
                </div>
                <?php else: ?>
                <div class="row">
                    <span class="label">Продолжительность:</span> <?php echo date_format($time,'H ч. i мин.'); ?>
                </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($record->floor !== null): ?>
            <div class="row">
                <span class="label">Этаж, номер кабинета:</span> <?php echo $record->floor; ?>
            </div>
            <?php endif; ?>

            <div class="row">
                <span class="label">Организатор:</span> <?php echo $record->organizer; ?>
            </div>

            <?php if(!empty($record->participant)): ?>
            <div class="row">
                <span class="label">Количество участников:</span> <?php echo $record->participant; ?>
            </div>
            <?php endif; ?>

            <div  class="row" style="margin-top: 20px">
                <?php echo $record->description; ?>
            </div>
        </div>
    </div>

    <br/>
    <br/>
    <div class="share42init fr" data-path="<?php echo "{$this->assetsBase}/images/"?>"></div>
    <br/>
    <br/>

    <?php if(!empty($record->place)): ?>
    <style type="text/css">
        .image {
            position: relative;
        }
        #map {
            width: 470px;
            height: 308px;
        }
        img + #map {
            position: absolute;
            left: -9999px;
            top: 0;
        }
    </style>
    <script>
        $('#show_map').show().on('click', function(){
            $('#map').css('left', 0);
        });
        $('#map').css('height', $('.image img').height());

        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map('map', {
                center: [<?php echo $record->latitude; ?>, <?php echo $record->longitude; ?>],
                zoom: 14,
                controls: ['smallMapDefaultSet']
            }, {
                autoFitToViewport: 'always'
            });

            var button = new ymaps.control.Button({
                data: {
                    content: "Закрыть карту"
                },
                options: {
                    position: {right: 150, top: 10},
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

            myMap.geoObjects.add(new ymaps.Placemark([<?php echo $record->latitude; ?>, <?php echo $record->longitude; ?>], {
                balloonContentHeader: '<?php echo $record->title; ?>',
                balloonContentBody: '<?php echo $record->place; ?> <br><strong>Начало:</strong> <?php echo Rudate::date(date('d F, H:i', $record->date)); ?>' +
                '<br><strong>Окончание:</strong> <?php echo Rudate::date(date('d F, H:i', $record->duration)); ?>'
            }, {
                preset: 'islands#icon',
                iconColor: '#32923D'
            }));
         }
    </script>
    <?php endif; ?>

</div>

