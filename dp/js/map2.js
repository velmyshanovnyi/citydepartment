var map, mapCategories, $mapCategories;
function initMap2() {
    ymaps.modules.require(['Heatmap'], function (Heatmap) {
        $.get('http://definerak.pythonanywhere.com/5&6&7&8&9&10&11&12&13&14', function (json) {
            var centerPoint = {
                latitude: 0,
                longitude: 0
            }, count = 0;
            for (var i in json.features) {
                centerPoint.latitude += parseFloat(json.features[i]['geometry']['coordinates'][0]);
                centerPoint.longitude += parseFloat(json.features[i]['geometry']['coordinates'][1]);
                count++;
            }
            map = new ymaps.Map("map", {
                center: [centerPoint.latitude / count, centerPoint.longitude / count],
                zoom: 5
            });

            var heatmap = new Heatmap(json);
            heatmap.setMap(map);
        }, 'json').fail(function () {
            alert('occurs error while loading geodata');
        });
    });
}
function initMapJson2(json) {
    mapCategories = document.getElementById('mapCategories');
    $mapCategories = $(mapCategories);
    map = new ymaps.Map("map", {
        center: [55.76, 37.64],
        zoom: 5
    });
}