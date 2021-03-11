
$('#sucursal-click').on('click', function () {

    singleListingMap();




})
function singleListingMap() {
    navigator.geolocation.getCurrentPosition(async function (position) {
        if (document.getElementById("map") !== null) {
            if ($('#map').attr('data-map-scroll') == 'true' || $(window).width() < 992) {
                var scrollEnabled = false;
            } else {
                var scrollEnabled = true;
            }
            var mapOptions = {
                gestureHandling: scrollEnabled,
            }
            window.map = L.map('map', mapOptions);
            $('#scrollEnabling').hide();

            function locationData(locationURL, locationImg, locationTitle, locationAddress, locationRating, locationRatingCounter) {
                return ('' +
                    '<a href="' + locationURL + '" class="leaflet-listing-img-container">' +
                    '<div class="infoBox-close"><i class="fa fa-times"></i></div>' +
                    '<img src="' + locationImg + '" alt="">' +
                    '<div class="leaflet-listing-item-content">' +
                    '<h3>' + locationTitle + '</h3>' +
                    '<span>' + locationAddress + '</span>' +
                    '</div>' +
                    '</a>' +
                    '<div class="leaflet-listing-content">' +
                    '<div class="leaflet-listing-title">' +
                    '<div class="' + infoBox_ratingType + '" data-rating="' + locationRating + '"><div class="rating-counter">(' + locationRatingCounter + ' reviews)</div></div>' +
                    '</div>' +
                    '</div>')
            }
            var infoBox_ratingType = 'star-rating';
            map.on('popupopen', function () {
                if (infoBox_ratingType = 'numerical-rating') {
                    numericalRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
                if (infoBox_ratingType = 'star-rating') {
                    starRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
            });
            let locations = []
            let user_id = $('#user_id').val();
            let { data: data } = await axios.get(`/list-sucursales?id=${user_id}`);
            let icon = `<i class='im im-icon-Map-Marker'></i>`;
            let user = data.user;
            locations.push([locationData(' /resultados/' + user.slug + '/' + user.id, '/images/' + user.image,
                user.company, user.company, '3.5', '12'), user.latitude, user.longitude, 1, icon])

            data.branches.forEach(element => {


                locations.push([
                    locationData(' /resultados/' + element.slug + '/' + element.id, '/images/' + element.image,
                        element.company, element.company, '3.5', '12'),
                    element.latitude, element.longitude, 1, icon]);
            });

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}@2x.png?access_token={accessToken}', {
                attribution: " &copy;  <a href='https://www.mapbox.com/about/maps/'>Mapbox</a> &copy;  <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>",
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoidmFzdGVyYWQiLCJhIjoiY2p5cjd0NTc1MDdwaDNtbnVoOGwzNmo4aSJ9.BnYb645YABOY2G4yWAFRVw'
            }).addTo(map);
            markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
            });
            for (var i = 0; i < locations.length; i++) {
                var listeoIcon = L.divIcon({
                    iconAnchor: [20, 51],
                    popupAnchor: [0, -51],
                    className: 'listeo-marker-icon',
                    html: '<div class="marker-container">' +
                        '<div class="marker-card">' +
                        '<div class="front face">' + locations[i][4] + '</div>' +
                        '<div class="back face">' + locations[i][4] + '</div>' +
                        '<div class="marker-arrow"></div>' +
                        '</div>' +
                        '</div>'
                });
                var popupOptions = {
                    'maxWidth': '270',
                    'className': 'leaflet-infoBox'
                }
                var markerArray = [];

                marker = new L.marker([locations[i][1], locations[i][2]], {
                    icon: listeoIcon,
                }).bindPopup(locations[i][0], popupOptions);
                marker.on('click', function (e) { });

                map.on('popupopen', function (e) {
                    L.DomUtil.addClass(e.popup._source._icon, 'clicked');
                }).on('popupclose', function (e) {
                    if (e.popup) {
                        L.DomUtil.removeClass(e.popup._source._icon, 'clicked');
                    }
                });
                markers.addLayer(marker);
            }
            map.addLayer(markers);
            markerArray.push(markers);
            if (markerArray.length > 0) {
                map.fitBounds(L.featureGroup(markerArray).getBounds().pad(0.2));
            }
            map.removeControl(map.zoomControl);
            var zoomOptions = {
                zoomInText: '<i class="fa fa-plus" aria-hidden="true"></i>',
                zoomOutText: '<i class="fa fa-minus" aria-hidden="true"></i>',
            };
            var zoom = L.control.zoom(zoomOptions);
            zoom.addTo(map);
        }

    });
}