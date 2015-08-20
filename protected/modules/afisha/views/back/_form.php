<?php
/* @var $this AdminController */
/* @var $model Afisha */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
    )); ?>

    <div class="form-left">

        <h1> <?php echo CHtml::encode($model->isNewRecord ? 'Создание мероприятия' : 'Редактирование мероприятия'); ?></h1>

        <?php echo $form->errorSummary($model); ?>

        <div class="row">
            <?php echo $form->labelEx($model, 'title'); ?>
            <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'title'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'organizer'); ?>
            <?php echo $form->textField($model, 'organizer', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'organizer'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'place'); ?>
            <?php echo $form->textField($model, 'place', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'place'); ?>
        </div>

        <div class="row">
            <label>Указать местоположение на карте (кликнике в нужном месте или перетащите метку) </label>
            <?php echo $form->hiddenField($model, 'latitude'); ?>
            <?php echo $form->hiddenField($model, 'longitude'); ?>
            <div id="map" style="width: 100%; height: 400px"></div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'floor'); ?>
            <?php echo $form->textField($model, 'floor', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'floor'); ?>
        </div>

<!--        <div class="row">-->
<!--            --><?php //echo $form->labelEx($model, 'preview'); ?>
<!--            --><?php //$this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'preview')); ?>
<!--            --><?php //echo $form->error($model, 'preview'); ?>
<!--        </div>-->

        <div class="row">
            <?php echo $form->labelEx($model, 'description'); ?>
            <?php $this->widget('application.extensions.eckeditor.ECKEditor', array('model' => $model, 'attribute' => 'description')); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>

    </div>

    <div class="form-right">
        <div class="row buttons">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-blue')); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'participant'); ?>
            <?php echo $form->textField($model, 'participant', array('size' => 60, 'maxlength' => 255)); ?>
            <?php echo $form->error($model, 'participant'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'date'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Afisha[date]',
                'value' => date('Y-m-d H:i', $model->date ? $model->date : time()),
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'date'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'duration'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Afisha[duration]',
                'value' => $model->duration ? date('Y-m-d H:i', $model->duration) : '',
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'duration'); ?>
        </div>

        <div class="row">
            <div class="checkbox-list">
                <?php echo $form->checkBox($model, 'state'); ?>
                <?php echo $form->labelEx($model, 'state'); ?>
                <?php echo $form->error($model, 'state'); ?>
            </div>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'state_date'); ?>
            <?php
            $this->widget('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker', array(
                'model' => $model,
                'name' => 'Afisha[state_date]',
                'value' => date('Y-m-d H:i', $model->state_date ? $model->state_date : time()),
                'mode' => 'datetime',
                'options'=>array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'hh:mm',
                ),
            ));
            ?>
            <?php echo $form->error($model, 'state_date'); ?>
        </div>

        <div class="row">
            <?php echo $form->labelEx($model, 'photo'); ?>
            <?php $this->widget('FileUpload', array('model' => $model, 'attribute' => 'photo')); ?>
            <?php echo $form->error($model, 'photo'); ?>
        </div>

    </div>
<?php $this->endWidget(); ?>
</div>

<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"> </script>
<script>
    $('#show_map').show().on('click', function(){
        $('#map').css('left', 0);
    });
    $('#map').css('height', $('.image img').height());

    ymaps.ready(init);

    function init() {
        var coords = [<?php echo (!empty($model->latitude))?$model->latitude:56.506980; ?>,<?php echo (!empty($model->longitude))?$model->longitude : 84.948691; ?>];

        var myMap = new ymaps.Map('map', {
            center: coords,
            zoom: 11
        });

        myMap.behaviors.disable('scrollZoom');

        var myPlacemark = new ymaps.Placemark(coords, {}, {
            preset: 'islands#icon',
            iconColor: '#32923D',
            draggable: true
        });

        myMap.geoObjects.add(myPlacemark);
        // Слушаем событие окончания перетаскивания на метке.
        myPlacemark.events.add('dragend', function () {
            recordCoords(myPlacemark.geometry.getCoordinates());
        });

        // Слушаем клик на карте
        myMap.events.add('click', function (e) {
            coords = e.get('coords');

            // Если метка уже создана – просто передвигаем ее
            if (myPlacemark) {
                myPlacemark.geometry.setCoordinates(coords);
            }
            recordCoords(coords);
        });

        var searchControl = myMap.controls.get('searchControl');
        searchControl.events.add('resultshow', function () {
            var geoObjectsArray = searchControl.getResultsArray();
            var index = searchControl.getSelectedIndex();
            if (geoObjectsArray.length) {
                searchControl.hideResult();

                $('#Afisha_place').val(geoObjectsArray[index].properties.get('text'));
                // Если метка уже создана – просто передвигаем ее
                var coords = geoObjectsArray[index].geometry.getCoordinates();
                if (myPlacemark) {
                    myPlacemark.geometry.setCoordinates(coords);
                }
                recordCoords(coords);
            }

        }, this);

        // Записываем координаты
        function recordCoords(coords) {
            $('#Afisha_latitude').val(coords[0]);
            $('#Afisha_longitude').val(coords[1]);

            ymaps.geocode(coords, {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);
                $('#Afisha_place').val(firstGeoObject.properties.get('text'));
            });
        }
    }
</script>