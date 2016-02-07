var map, categories = {}, categoryClasters = {}, mapCategories, $mapCategories;
function initMap() {
    $.get('http://definerak.pythonanywhere.com/5&6&7&8&9&10&11&12&13&14', initMapJson, 'json')
            .fail(function () {
                alert('occurs error while loading geodata');
            });
}
function initMapJson(json) {
    map = new ymaps.Map("map", {
        center: [30, 0],
        zoom: 12
    });
    // init category clasters
    $.ajax({
        url: 'data/categories.json',
        dataType: 'json',
        async: false,
        success: function (json) {
            categories = json;
        }
    });
    for (var i in categories) {
        categoryClasters[categories[i]['id']] = new ymaps.ObjectManager({
            // Setting an option to make placemarks start clusterizing.
            clusterize: true,
            // ObjectManager accepts the same options as the clusterer.
            gridSize: 32,
            clusterIcons: [{
                    href: 'http://test.iov.zt.ua/getClusterImg.php?color=' + categories[i]['color'],
                    size: [50, 50],
                    offset: [0, 0]
                }]
        });
    }
    var markerCenterPosition = {latitude: 0, longitude: 0}, count = 0;
    for (var i in json.features) {
        var category = (json.features[i]['properties']['category_id']).toString();
        try {
            categoryClasters[category].add({
                "type": "Feature",
                "geometry": {
                    "type": "Point",
                    "coordinates": json.features[i]['geometry']['coordinates']
                },
                "options": {
                    "iconColor": "#" + categories[category]['color']
                },
                "properties": {
                    "hintContent": "Содержимое текстовой подсказки.",
                    "balloonContentBody": "Содержимое балуна.",
                }
            });
        } catch (ex) {
            console.log(ex);
        }
        // get center of all markers
        markerCenterPosition.latitude += parseFloat(json.features[i]['geometry']['coordinates'][0]);
        markerCenterPosition.longitude += parseFloat(json.features[i]['geometry']['coordinates'][1]);
        count++;
    }
    // add object managers
    for (var i in categoryClasters) {
        map.geoObjects.add(categoryClasters[i]);
    }
    // set center
    markerCenterPosition.latitude = markerCenterPosition.latitude / count;
    markerCenterPosition.longitude = markerCenterPosition.longitude / count;
    map.setCenter([markerCenterPosition.latitude, markerCenterPosition.longitude]);
}

/* bof - category init */
$("#category-list").on("click", ".js-input", function () {
    var $this = $(this), id = $this.attr("data-id");
    if ($this.hasClass("active")) {
        $this.removeClass("active");
        categoryClasters[id].objects.removeAll();
        map.container.fitToViewport();
    } else {
        $this.addClass("active");
        $.get('http://definerak.pythonanywhere.com/' + id, function (json) {
            categoryClasters[id].objects.add(json);
        }, 'json').fail(function () {
            alert('occurs error while loading geodata');
        });
    }
    return false;
});
/* eof - category init */