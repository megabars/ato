<div id="facy-maps" class="facy-maps"></div>

<script>
    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map('facy-maps', {
            center: [49.122853,55.786764],
            zoom: 6
        });

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