//$(document).ready(function () {
if (document.getElementById("map") !== null) {
    if ($('#map').attr('data-map-scroll') == 'true' || $(window).width() < 992) {
        var scrollEnabled = false;
    } else {
        var scrollEnabled = true;
    }
    var mapOptions = {
        gestureHandling: false,
        zoom: 18,
    }
    let paginator = {
        pagesNumber(pagination) {
            let offset = 8;

            if (!pagination.to) {
                return [];
            }

            var from = pagination.current_page - offset;
            if (from < 1) {
                from = 1;
            }

            var to = from + (offset * 2);
            if (to >= pagination.last_page) {
                to = pagination.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        setPaginatorHTML(data) {
            let numberPager = this.pagesNumber(data);

            let html = [], preview, next;
            for (let i = 0; i < numberPager.length; i++) {
                let active = numberPager[i] == data.current_page ? 'active' : '';
                if (data.current_page > 1) {
                    preview = `<li class="page-item" >
                                <a class="page-link"  onclick="paginator.cambiarPagina('${data.current_page - 1}')">Ant</a>
                            </li>`
                }
                if (data.current_page < data.last_page) {
                    next = `<li class="page-item "  >
                            <a class="page-link "  onclick="paginator.cambiarPagina('${data.current_page + 1}')">Sig</a>
                        </li>`
                }
                html[i] = `<li class="page-item  ${active}">
                        <a class="page-link" onclick="paginator.cambiarPagina(${numberPager[i]})">${numberPager[i]}</a>
                        </li>`
            }
            html.unshift(preview);
            html.push(next);

            return html;
        }, cambiarPagina(page) {
            this.getUsers(page);
        }, async getUsers(page = 0) {

            map.eachLayer(function (layer) {
                map.removeLayer(layer);
            });

            department_id = $('#department').val() || '';
            province_id = $('#province').val() || '';
            district_id = $('#district').val() || '';
            business = $('#business').val() || '';

            let { data: data } = await axios.get(`/list-restaurant?business=${business}&department=${department_id}&province=${province_id}&district=${district_id}&page=${page}`);

            let locations = [];

            $('#cantCompany').text(data.users.data.length)
            let html = paginator.setPaginatorHTML(data.pagination);
            $('#paginationNav ul').empty().append(html);
            data.users.data.forEach(element => {
                let icon = `<i class='im im-icon-Map-Marker'></i>`;


                locations.push([
                    locationData(
                        ' /resultados/' + element.slug + '/' + element.id, '/images/' + element.image,
                        element.company, element.company, '3.5', '12'),
                    element.latitude, element.longitude, 1, icon]);
            });
            var infoBox_ratingType = 'star-rating';
            map.on('popupopen', function () {
                if (infoBox_ratingType = 'numerical-rating') {
                    numericalRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
                if (infoBox_ratingType = 'star-rating') {
                    starRating('.leaflet-popup .' + infoBox_ratingType + '');
                }
            });
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}@2x.png?access_token={accessToken}', {
                attribution: " &copy;  <a href='https://www.mapbox.com/about/maps/'>Mapbox</a> &copy;  <a href='http://www.openstreetmap.org/copyright'>OpenStreetMap</a>",
                maxZoom: 15,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoidmFzdGVyYWQiLCJhIjoiY2p5cjd0NTc1MDdwaDNtbnVoOGwzNmo4aSJ9.BnYb645YABOY2G4yWAFRVw'
            }).addTo(map);

            markers = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: true,
            });
            var markerArray = [];

            for (var i = 0; i < locations.length; i++) {
                var listeoIcon = L.divIcon({
                    iconAnchor: [20, 51],
                    popupAnchor: [0, -51],
                    className: 'listeo-marker-icon',
                    html: '<div class="marker-container">' +
                        '<div class="marker-card">' +
                        '<div class="front face" style="border-color: #4CAF50;color: #4CAF50;">' + locations[i][4] + '</div>' +
                        '<div class="back face" style="background: #4CAF50;border-color: #4CAF50;">' + locations[i][4] + '</div>' +
                        '<div class="marker-arrow" style="border-color: #4CAF50 transparent transparent;"></div>' +
                        '</div>' +
                        '</div>'
                });
                var popupOptions = {
                    'maxWidth': '270',
                    'className': 'leaflet-infoBox'
                }


                marker = new L.marker([locations[i][1], locations[i][2]], {
                    icon: listeoIcon,
                }).bindPopup(locations[i][0], popupOptions);


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
                map.fitBounds(L.featureGroup(markerArray).getBounds());
                navigator.geolocation.getCurrentPosition(position => {
                    const latlngs = [
                        [position.coords.latitude, position.coords.longitude],
                        [position.coords.latitude, position.coords.longitude]

                    ];
                    var polyline = L.polyline(latlngs, { color: '#e8e0d9' }).addTo(map);
                    map.fitBounds(polyline.getBounds(), false, { padding: 20 });

                })
            }
            map.removeControl(map.zoomControl);
            var zoomOptions = {
                zoomInText: '<i class="fa fa-plus" aria-hidden="true"></i>',
                zoomOutText: '<i class="fa fa-minus" aria-hidden="true"></i>',
            };
            var zoom = L.control.zoom(zoomOptions);
            zoom.addTo(map);
        }


    }


    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    const urlParams = new URLSearchParams(window.location.search);
    const business_id = urlParams.get('business');
    let business = ''
    if (business_id) {
        business = business_id;
    } else {
        business = $('#business').val()
    }
    $("#business option[value='" + business + "']").prop("selected", "selected")
    $('select[name=category]').trigger("chosen:updated");

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
            '</div>' +
            '</div>')
    }
    paginator.getUsers();
    $('#department').change(async function () {

        // $('#map .leaflet-pane .leaflet-marker-pane').empty()
        $('#map .leaflet-control-container .leaflet-top').empty()
        this.paginator.getUsers();
    })
    $('#province').change(async function () {
        //  $('#map .leaflet-pane .leaflet-marker-pane').empty()
        $('#map .leaflet-control-container .leaflet-top').empty()
        this.paginator.getUsers();
    })
    $('#district').change(async function () {
        //$('#map .leaflet-pane .leaflet-marker-pane').empty()
        $('#map .leaflet-control-container .leaflet-top').empty()

        this.paginator.getUsers();
    })
    $('#business').change(async function () {

        //  $('#map .leaflet-pane .leaflet-marker-pane').empty();
        $('#map .leaflet-control-container .leaflet-top').empty();
        this.paginator.getUsers();
    })
}

