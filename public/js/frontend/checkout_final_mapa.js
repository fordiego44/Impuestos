
    $(document).ready(async function () {

        const { data: info } = await axios.get(`https://ipinfo.io?token=06e6161325a723`)
        const { data: city } = await axios.get(`/search-department?info=${info.city}`)



        if(info.country == "PE"){
            if($("#departamento").val() == ""){

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
                function showPosition(position) {

                    $('#longitud').val(position.coords.longitude);
                    $('#latitud').val(position.coords.latitude);


                    //position.coords.longitude,position.coords.latitude
                    geocoder(position.coords.longitude, position.coords.latitude);
                    longitud = $('#longitud').val();
                    latitud = $('#latitud').val();

                    let bounds = limites(city.toString(),1);

                    ubication_map(bounds,longitud,latitud);


                }

            }
            else{
                let bounds = limites($('#departamento').val(),1);
                let longitud = limites($('#departamento').val(),2);
                let latitud = limites($('#departamento').val(),3);
                $('#longitud').val(longitud);
                $('#latitud').val(latitud);

                ubication_map(bounds,longitud,latitud);
            }
        }
        else{
            let bounds = limites("23",1);
            let longitud = limites("23",2);
            let latitud = limites("23",3);
            $('#longitud').val(longitud);
            $('#latitud').val(latitud);
            ubication_map(bounds,longitud,latitud);
        }

    })

$('#departamento').on('change',function(){
    console.log($(this).val());
    let id = $(this).val();
    let bounds = limites(id,1);
    let longitud = limites(id,2);
    let latitud = limites(id,3);
    console.log(bounds,longitud,latitud);

    /*$('#map').remove();
    $('#mapa').append(`<div id='map' class="col-md-8 mapa" style="padding-top: 15px;width: 100%;height: 500px;">
    </div>`);
    geocoder(longitud,latitud);
    $('#longitud').val(longitud);
    $('#latitud').val(latitud);*/
    ubication_map(bounds,longitud,latitud);
})


function ubication_map(bounds,longitud,latitud){
    $('#map').remove();
    $('#mapa').append(`<div id='map' class="col-md-8 mapa" style="padding-top: 15px;width: 100%;height: 500px;">
    </div>`);
    mapboxgl.accessToken = 'pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw';
    geocoder(longitud,latitud);
    $('#longitud').val(longitud);
    $('#latitud').val(latitud);

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [longitud, latitud],
        zoom: 13,
        maxBounds: bounds,
        doubleClickZoom: false
    });


    map.addControl(new MapboxGeocoder({
        accessToken: mapboxgl.accessToken
    }));

    map.addControl(new mapboxgl.NavigationControl());
    map.addControl(new mapboxgl.FullscreenControl());
    let geolocate = map.addControl(
        new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: false
        },
        trackUserLocation: true
        })
        //console.log("");

    );
    //console.log(geolocate);
    var marker = new mapboxgl.Marker({
        draggable: true
        })
    .setLngLat([longitud, latitud])
    .addTo(map);

    map.on('dblclick', function(e) {
        console.log('A dblclick event has occurred at ' + e.lngLat);
        $('.mapboxgl-marker').remove();
        $('#longitud').val(e.lngLat.lng);
        $('#latitud').val(e.lngLat.lat);
        geocoder(e.lngLat.lng, e.lngLat.lat);
        var marker = new mapboxgl.Marker({
            draggable: true
            })
        .setLngLat([e.lngLat.lng, e.lngLat.lat])
        .addTo(map);
        function onDragEnd() {
            var lngLat = marker.getLngLat();

            $('#longitud').val(lngLat.lng);
            $('#latitud').val(lngLat.lat);
            console.log(lngLat.lng,lngLat.lat);
            //$('#longitud_auxiliar').val(lngLat.lng);
            //$('#latitud_auxiliar').val(lngLat.lat);
            //let location = ""+lngLat.lng+","+lngLat.lat;
            geocoder(lngLat.lng,lngLat.lat);
        }
        marker.on('dragend', onDragEnd);

    });



    function onDragEnd() {
        var lngLat = marker.getLngLat();

        $('#longitud').val(lngLat.lng);
        $('#latitud').val(lngLat.lat);
        console.log(lngLat.lng,lngLat.lat);
        //$('#longitud_auxiliar').val(lngLat.lng);
        //$('#latitud_auxiliar').val(lngLat.lat);
        //let location = ""+lngLat.lng+","+lngLat.lat;
        geocoder(lngLat.lng,lngLat.lat);
    }
    function geocoder(longitud,latitud){
        $.ajax({
                url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+longitud+","+latitud+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
                dataType: "json",
                type: "GET"
                }).done(function(data) {

                    //console.log(data.features[0].context);

                    console.log(data.features)
                    $('#direccion').val(data.features[0].place_name);
                    for (let i = 0; i < data.features.length; i++) {

                        let miCadena = data.features[i].id;
                        var divisiones = miCadena.split(".", 1);
                        //console.log(divisiones)
                        if(divisiones == "country"){
                            console.log("Pais: "+ data.features[i].text);
                        }
                        if(divisiones == "region"){
                            console.log("Region: "+ data.features[i].text);
                        }
                        if(divisiones == "place"){
                            console.log("Distrito: "+ data.features[i].text);
                        }
                        //console.log("*//////////////////////////////*")

                    }
                    //var divisiones = miCadena.split(" ", 1);
                });

    }
    marker.on('dragend', onDragEnd);
    //$('#longitud').val(0);
    //$('#latitud').val(0);
}
function geocoder(longitud,latitud){
    $.ajax({
            url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+longitud+","+latitud+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
            dataType: "json",
            type: "GET"
            }).done(function(data) {


                $('#direccion').val(data.features[0].place_name);
                    for (let i = 0; i < data.features.length; i++) {

                        let miCadena = data.features[i].id;
                        var divisiones = miCadena.split(".", 1);
                        //console.log(divisiones)
                        if(divisiones == "country"){
                            console.log("Pais: "+ data.features[i].text);
                        }
                        if(divisiones == "region"){
                            console.log("Region: "+ data.features[i].text);
                        }
                        if(divisiones == "place"){
                            console.log("Distrito: "+ data.features[i].text);
                        }

                    }
            });
}
function limites(id,signal){
    let bounds;
    let longitud;
    let latitud;
    switch(id){
        case "01": case "Amazonas":
            //Amazonas
            /*-78.70188953622026 -7.058988353179615
            -77.27162966368492 -2.8916216746198984
            -77.87208588951192 -6.190722848049347
            -77.87157119624027 -6.229851950164971*/
            bounds = [
                [-78.70188953622026, -7.058988353179615], // Southwest coordinates
                [-77.27162966368492, -2.8916216746198984] // Northeast coordinates
            ];
            longitud = -77.87157119624027;
            latitud = -6.229851950164971;
            break;
        case "02": case "Áncash":
            //Áncash
            /*-78.56848791026297 -10.891754007525094
            -76.70204682907317 -7.958051826022242
            -77.52970280018948 -9.528361794237142*/
            bounds = [
                [-78.56848791026297, -10.891754007525094], // Southwest coordinates
                [-76.70204682907317, -7.958051826022242] // Northeast coordinates
            ];
            longitud = -77.52970280018948;
            latitud = -9.528361794237142;
            break;
        case "03": case "Apurímac":
            //Apurímac
            /*-73.85273563716905 -14.980683454946444
            -72.060933294378 -13.021615751126689

            -72.88147535934553 -13.636573035297872*/
            bounds = [
                [-73.85273563716905, -14.980683454946444], // Southwest coordinates
                [-72.060933294378, -13.021615751126689] // Northeast coordinates
            ];
            longitud = -72.88147535934553;
            latitud = -13.636573035297872;
            break;
        case "04": case "Arequipa":
            //Arequipa
            /*-75.56811951779875, -17.423760005109116
            -70.72591368922599, -14.562557247137235
            -71.53694871333445, -16.398866543704813*/
            bounds = [
                [-75.56811951779875, -17.423760005109116], // Southwest coordinates
                [-70.72591368922599, -14.562557247137235] // Northeast coordinates
            ];
            longitud = -71.53694871333445;
            latitud = -16.398866543704813;
            break;
        case "05": case "Ayacucho":
            //Ayacucho
            /*-75.156844855601 -15.57853743915176
            -72.72452339013057 -12.013237819285777
            -74.22510569281306 -13.158349650791777*/
            bounds = [
                [-75.156844855601, -15.57853743915176], // Southwest coordinates
                [-72.72452339013057, -12.013237819285777] // Northeast coordinates
            ];
            longitud = -74.22510569281306;
            latitud = -13.158349650791777;
            break;
        case "06": case "Cajamarca":
            //Cajamarca
            /*-79.37544506312551 -7.925659894649613
            -77.73581302519108 -4.5190195457006865
            -78.52937587353337 -7.116053503177085*/
            bounds = [
                [-79.37544506312551, -7.925659894649613], // Southwest coordinates
                [-77.73581302519108, -4.5190195457006865] // Northeast coordinates
            ];
            longitud = -78.52937587353337;
            latitud = -7.16053503177085;
            break;
        case "07": case "Callao":
            //Callao
            /*-77.17457513257973 -12.087273861505906
            -77.09058346021347 -11.813133084369241
            -77.12879667436422 -12.060361324603733*/
            bounds = [
                [-77.17457513257973, -12.087273861505906], // Southwest coordinates
                [-77.09058346021347, -11.813133084369241] // Northeast coordinates
            ];
            longitud = -77.12879667436422;
            latitud = -12.060361324603733;
            break;
        case "08": case "Cusco":
            //Cuzco
            /*=>LIMITES:
            -74.13404201626385 -15.629303526119244
            -70.27608047650936 -11.092515218867106
            =>CENTER:

            -71.9708773064395 -13.520386328736208
            */
            bounds = [
                [-74.13404201626385, -15.629303526119244], // Southwest coordinates
                [-70.27608047650936, -11.092515218867106] // Northeast coordinates
            ];
            longitud = -71.9708773064395;
            latitud = -13.520386328736208;
            break;
        case "09": case "Huancavelica":
            //Huancavelica
            /*-75.78655810777055 -14.204456582130575
            -74.13658362014665 -11.828844111151184
            -74.9740735158894 -12.785083979409023*/
            bounds = [
                [-75.78655810777055, -14.204456582130575], // Southwest coordinates
                [-74.13658362014665, -11.828844111151184] // Northeast coordinates
            ];
            longitud = -74.9740735158894;
            latitud = -12.785083979409023;
            break;
        case "10": case "Huánuco":
            //Huánuco
            /*-77.36246420293219 -10.616947553634773
            -74.45057822794458 -8.19038959285966
            -76.24288062220424 -9.907319514973636*/
            bounds = [
                [-77.36246420293219, -10.616947553634773], // Southwest coordinates
                [-74.45057822794458, -8.19038959285966] // Northeast coordinates
            ];
            longitud = -76.24288062220424;
            latitud = -9.907319514973636;
            break;
        case "11": case "Ica":
            //Ica
            /**-76.22547725718324 -15.50114728607521
            -74.64383684649873 -12.915079093019344
            -75.73191537005152 -14.06458970131311*/
            bounds = [
                [-76.22547725718324, -15.50114728607521], // Southwest coordinates
                [-74.64383684649873, -12.915079093019344] // Northeast coordinates
            ];
            longitud = -75.73191537005152;
            latitud = -14.06458970131311;
            break;
        case "12": case "Junín":
            //JUNIN
            /*-76.38127665906379 -12.765796723061072
            -73.31167729816292 -10.502211137284093
            -75.20695448080548 -12.074351695662543 */
            bounds = [
                [-76.38127665906379, -12.765796723061072], // Southwest coordinates
                [-73.31167729816292, -10.502211137284093] // Northeast coordinates
            ];
            longitud = -75.20695448080548;
            latitud = -12.074351695662543;
            break;
        case "13": case "La Libertad":
            //LA LIBERTAD
            /*-79.62957548245743 -9.160082868786148
            -76.81346758547572 -6.680956909351693
            -79.02786928043132 -8.108836304418006
            */
            bounds = [
                [-79.62957548245743, -9.160082868786148], // Southwest coordinates
                [-76.81346758547572, -6.680956909351693] // Northeast coordinates
            ];
            longitud = -79.02786928043132;
            latitud = -8.108836304418006;
            break;
        case "14": case "Lambayeque":
            //LAMBAYQYE
            /*-80.64021300862203 -7.281375207890719
            -79.08776589509199 -5.395626100794928
            -79.82222401288921 -6.729767329561412*/
            bounds = [
                [-80.64021300862203, -7.281375207890719], // Southwest coordinates
                [-79.08776589509199, -5.395626100794928] // Northeast coordinates
            ];
            longitud = -79.82222401288921;
            latitud = -6.729767329561412;
            break;
        case "15": case "Lima": case "Lima Province":
            //LIMA
            /*-77.99793916177249 -13.500673905428414
            -75.55819962472982 -10.06451915686165
            -77.03646916730096 -12.060937537914938*/
            bounds = [
                [-77.99793916177249, -13.500673905428414], // Southwest coordinates
                [-75.55819962472982, -10.06451915686165] // Northeast coordinates
            ];
            longitud = -77.03646916730096;
            latitud = -12.060937537914938;
            break;
        case "16": case "Loreto":
            //LORETO
            /*bounds = [
                [-77.73053618021608, -8.930186222521186], // Southwest coordinates
                [-69.40848449137923, 0.1120380155423959] /
                -73.2552344043295 -3.7283300218569906*/
            bounds = [
                [-77.73053618021608, -8.930186222521186], // Southwest coordinates
                [-69.40848449137923, 0.1120380155423959] // Northeast coordinates
            ];
            longitud = -73.2552344043295;
            latitud = -3.7283300218569906;
            break;
        case "17": case "Madre de Dios":
            //MADRE DE DIOS
            /*=>LIMITES:
            -72.3242558872463 -13.334231073712928
            -68.59955181631777 -9.69715670238034

            =>CENTER

            -69.1902956834844 -12.59423156142114*/
            bounds = [
                [-72.3242558872463, -13.334231073712928], // Southwest coordinates
                [-68.59955181631777, -9.69715670238034] // Northeast coordinates
            ];
            longitud = -69.1902956834844;
            latitud = -12.59423156142114;
            break;
        case "18": case "Moquegua":
            //MOQUEGUA
            /*-71.59278276634525, -17.905245880032496
            -69.96181471282632, -15.9942035301585 */
            bounds = [
                [-71.59278276634525, -17.905245880032496], // Southwest coordinates
                [-69.96181471282632, -15.9942035301585] // Northeast coordinates
            ];
            longitud = -70.93455813548061;
            latitud = -17.193669156710342;
            break;
        case "19": case "Pasco":
            //PASCO
            /*-76.69613036618831 -11.267373492120186
            -74.11177341695515 -9.353175443124883
            -76.26104293849656 -10.655407150550346*/
            bounds = [
                [-76.69613036618831, -11.267373492120186], // Southwest coordinates
                [-74.11177341695515, -9.353175443124883 ] // Northeast coordinates
            ];
            longitud = -76.26104293849656;
            latitud = -10.655407150550346;
            break;
        case "20": case "Piura":
            //PIURA
            /*-81.3055451592967 -6.504105324000378
            -79.09041775615836 -3.9634561267575634
            -80.63206084136957 -5.178985785212248*/
            bounds = [
                [-81.3055451592967, -6.504105324000378], // Southwest coordinates
                [-79.09041775615836, -3.9634561267575634] // Northeast coordinates
            ];
            longitud = -80.63206084136957;
            latitud = -5.178985785212248;
            break;
        case "21": case "Puno": case "Calao":
            //PUNO
            /*-71.53694871333445, -16.398866543704813
            -68.64039121148778 -13.077672359964268

            -70.13158730321521 -15.489511373412142
            */
            bounds = [
                [-71.53694871333445, -16.398866543704813], // Southwest coordinates
                [-68.64039121148778, -13.077672359964268] // Northeast coordinates
            ];
            longitud = -70.13158730321521;
            latitud = -15.489511373412142;
            break;
        case "22": case "San Martín":
            //SAN MARTIN
            /*-77.53666259437375 -9.03698242541536
            -75.30322126351058 -5.297642564412243
            -76.36088732429968 -6.482449802149276*/
            bounds = [
                [-77.53666259437375, -9.03698242541536], // Southwest coordinates
                [-75.30322126351058, -5.297642564412243] // Northeast coordinates
            ];
            longitud = -76.36088732429968;
            latitud = -6.482449802149276;
            break;
        case "23": case "Tacna":
            //TACNA
            bounds = [
                [-71.15037206517002, -18.35882708416956], // Southwest coordinates
                [-69.47882051578074, -16.781660471111678] // Northeast coordinates
            ];
            longitud = -70.25177359274262;
            latitud = -18.014420029382848;
            break;
        case "24": case "Tumbes":
            //TUMBES
            /*=>LIMITES:
            -81.13355501027564 -4.248940510511673
            -80.10717459166946 -3.405410222913801
            -80.45154922714406 -3.563292733976141*/
            bounds = [
                [-81.13355501027564, -4.248940510511673], // Southwest coordinates
                [-80.10717459166946, -3.405410222913801] // Northeast coordinates
            ];
            longitud = -80.45154922714406;
            latitud = -3.563292733976141;
            break;
        case "25": case "Ucayali":
            //UCAYALI
            /*-75.6031500232781 -11.592984412611585
            -70.19846573191508 -7.045440385157363
            -74.53936317253508 -8.379250456816052 */
            bounds = [
                [-75.6031500232781, -11.592984412611585], // Southwest coordinates
                [-70.19846573191508, -7.045440385157363] // Northeast coordinates
            ];
            longitud = -74.53936317253508;
            latitud = -8.379250456816052;
            break;
        default:
            bounds = "Hola";
        break;

    }
    switch(signal){
        case 1:
            return bounds;
        case 2:
            return longitud;
        case 3:
            return latitud;
    }

}
