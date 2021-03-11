//const { data } = require("jquery");



    /*$("body").delegate('#myInputNumber', 'focusout', function(){
        if($(this).val() < 0){
            $(this).val('0');
        }
    }); */
$("#check-a").prop("disabled", true);
$("#check-a-tipo").prop("disabled", true);
function total(){
    let data = JSON.parse(localStorage.getItem("checkout"));
    let total = 0;

    if(data != null){
        if($('#state-delivery').val() == 1){

            if( $('#state-delivery-tipo').val() == 1){
                for(i = 0; i < data.length; i++){
                    total = total + data[i].subtotal + (data[i].subtotal * 0.15);
                }
            }

            else{
                for(i = 0; i < data.length; i++){
                    total = total + data[i].subtotal + (data[i].subtotal * 0.2);
                }
            }
        }
        else{
            for(i = 0; i < data.length; i++){
                total = total + data[i].subtotal;
            }
        }

        //total = 152.00;
        $('#transaction_amount').val(total.toFixed(2));
        //$('#transaction_amount').val("S/."+total.toFixed(2));
    }
    else{
        $('#transaction_amount').val(0);
    }

}
total();
/*CODIGO NUEVO PARA BOTONES */
$('.account-type-radio').on('click',function(){
    $('#state-delivery').val($(this).val());
    if($('#state-delivery').val() == 0){
        $('.delivery-dates').hide();
        $('#text-delivery').text("Ingrese sus datos para el recojo de sus productos:");
        total();
    }
    else{
        $('.delivery-dates').show();
        $('#text-delivery').text("Ingrese sus datos para el envio de sus productos:");
        total();
    }
    //consol
})

$('.account-type-radio-tipo').on('click',function(){
    $('#state-delivery-tipo').val($(this).val());
    total();
    //consol
})
/*CODIGO NUEVO PARA BOTONES */
$('.state-delivery').on('click',function(){
    //$("#_1234").prop("checked", true)
    $('#state-delivery').val($(this).val());
    if($('#state-delivery').val() == 0){
        $('.delivery-dates').hide();
    }
    else{
        $('.delivery-dates').show();
    }
    //console.log($(this).val());
});

$('#check-a').on('click',function(){
    //$("#_1234").prop("checked", true)
    $("#check-b").prop("disabled", false);
    $("#check-b").prop("checked", false);
    $(this).prop("disabled", true);
    total();
    $('#text-delivery').text("Ingrese sus datos para el envio de sus productos:");

});
$('#check-b').on('click',function(){
    $("#check-a").prop("disabled", false);
    $("#check-a").prop("checked", false);
    $(this).prop("disabled", true);
    total();
    $('#text-delivery').text("Ingrese sus datos para el recojo de sus productos:");
});
$('.state-delivery-tipo').on('click',function(){
    //$("#_1234").prop("checked", true)
    $('#state-delivery-tipo').val($(this).val());
    total();
    //console.log($(this).val());
});

$('#check-a-tipo').on('click',function(){
    //$("#_1234").prop("checked", true)
    $("#check-b-tipo").prop("disabled", false);
    $("#check-b-tipo").prop("checked", false);
    $(this).prop("disabled", true);
    total();

});
$('#check-b-tipo').on('click',function(){
    //$("#_1234").prop("checked", true)
    $("#check-a-tipo").prop("disabled", false);
    $("#check-a-tipo").prop("checked", false);
    $(this).prop("disabled", true);
    total();
});
function readTextFile(file, callback) {
                var rawFile = new XMLHttpRequest();
                rawFile.overrideMimeType("application/json");
                rawFile.open("GET", file, true);
                rawFile.onreadystatechange = function() {
                 if (rawFile.readyState === 4 && rawFile.status == "200") {
                  callback(rawFile.responseText);
                 }
                }
                rawFile.send(null);
                //return
            }
$('#image').on('change',function(){
    $('.message-error').empty();
    $('.message-file').empty();
    var archivoInput = document.getElementById('image');
    var archivoRuta = archivoInput.value;
    var extPermitidas = /(.JPG|.jpg|.png|.PNG|.jpeg|.JPEG)$/i;
    if(!extPermitidas.exec(archivoRuta)){
        $('.message-file').empty().append(`<div class="notification error closeable">
        <p> <i class="fa fa-times-circle"></i>    El archivo no es una imagen. Asegures de tener una extensión .jpeg, .png, .jpg</p>

    </div>`);
        archivoInput.value = '';
        return false;
    }

})
$('.guardar').on('click',function(){


        if($('#state-delivery').val() == "0"){
            console.log($('#state-delivery').val());
            $('#nombre').val() != "" ? $('#nombre').css("border-color", "#4CAF50"):$('#nombre').css("border-color", "#FA3B3B");
            $('#apellido').val() != "" ? $('#apellido').css("border-color", "#4CAF50"):$('#apellido').css("border-color", "#FA3B3B");
            //$('#direccion').val() != "" ? $('#direccion').css("border-color", "#4CAF50"):$('#direccion').css("border-color", "#FA3B3B");
            //$('#telefono').val() != "" ? $('#telefono').css("border-color", "#4CAF50"):$('#telefono').css("border-color", "#FA3B3B");
            //$('#celular').val() != "" ? $('#celular').css("border-color", "#4CAF50"):$('#celular').css("border-color", "#FA3B3B");
            $('#country').val() != "" ? $('#country').css("border-color", "#4CAF50"):$('#country').css("border-color", "#FA3B3B");
            let email=$('#email_address').val()
            let senal ="";
            var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
            if (! caract.test(email)){
                $('#email_address').css("border-color", "#FA3B3B")

            }else{
                $('#email_address').css("border-color", "#4CAF50")
                senal = "true";
            }
            if ($('#telefono').val() == ""){

                if($('#celular').val() == ""){
                    $('#telefono').css("border-color", "#FA3B3B");
                    $('#celular').css("border-color", "#FA3B3B");
                }
                else{
                    $('#telefono').css("border-color", "#4CAF50");
                    $('#celular').css("border-color", "#4CAF50");
                }

            }
            else{
                $('#telefono').css("border-color", "#4CAF50");
                $('#celular').css("border-color", "#4CAF50");
            }
            //$('#celular').val() > 1 ? $('#celular').css("border-color", "#4CAF50"):$('#celular').css("border-color", "#FA3B3B");
            //$('#telefono').val() > 1 ? $('#telefono').css("border-color", "#4CAF50"):$('#telefono').css("border-color", "#FA3B3B");

            if($('#nombre').val() != "" && $('#apellido').val() != "" && senal != "")
            {
                if($('#telefono').val() != "" || $('#celular').val() != "" ){
                    //if($('#telefono').val() != "" || $('#celular').val() != "")
                    let value = $('#email_address').val();
                    let nombre = $('#nombre').val();
                    let apellido = $('#apellido').val();
                    $('#cardholderName').val(nombre + ' '+apellido);
                    $('#email').val(value);
                    console.log($('#email').val());
                    $('.tabs-nav > .active').next('li').find('a').trigger('click');
                    $('#pasos').empty().append("Paso 2 de 3: Métodos de Pago")
                }

            }
        }
        else{

            $('#nombre').val() != "" ? $('#nombre').css("border-color", "#4CAF50"):$('#nombre').css("border-color", "#FA3B3B");
            $('#apellido').val() != "" ? $('#apellido').css("border-color", "#4CAF50"):$('#apellido').css("border-color", "#FA3B3B");
            $('#direccion').val() != "" ? $('#direccion').css("border-color", "#4CAF50"):$('#direccion').css("border-color", "#FA3B3B");
            $('#departamento').val() != "" ? $('#departamento').css("border-color", "#4CAF50"):$('#departamento').css("border-color", "#FA3B3B");
            $('#provincia').val() != "" ? $('#provincia').css("border-color", "#4CAF50"):$('#provincia').css("border-color", "#FA3B3B");
            $('#distrito').val() != "" ? $('#distrito').css("border-color", "#4CAF50"):$('#distrito').css("border-color", "#FA3B3B");
            $('#country').val() != "" ? $('#country').css("border-color", "#4CAF50"):$('#country').css("border-color", "#FA3B3B");
            let email=$('#email_address').val()
            let senal ="";
            var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
            if (! caract.test(email)){
                $('#email_address').css("border-color", "#FA3B3B")

            }else{
                $('#email_address').css("border-color", "#4CAF50")
                senal = "true";
            }
            if ($('#telefono').val() == ""){

                if($('#celular').val() == ""){
                    $('#telefono').css("border-color", "#FA3B3B");
                    $('#celular').css("border-color", "#FA3B3B");
                }
                else{
                    $('#telefono').css("border-color", "#4CAF50");
                    $('#celular').css("border-color", "#4CAF50");
                }

            }
            else{
                $('#telefono').css("border-color", "#4CAF50");
                $('#celular').css("border-color", "#4CAF50");
            }
            //$('#celular').val() > 1 ? $('#celular').css("border-color", "#4CAF50"):$('#celular').css("border-color", "#FA3B3B");
            //$('#telefono').val() > 1 ? $('#telefono').css("border-color", "#4CAF50"):$('#telefono').css("border-color", "#FA3B3B");

            if($('#nombre').val() != "" && $('#apellido').val() != "" && $('#direccion').val() != "" &&  $('#country').val() != "" && senal != "" && $('#departamento').val() != "" && $('#provincia').val() != "" && $('#distrito').val() != "")
            {
                if($('#telefono').val() != "" || $('#celular').val() != "" ){
                    //if($('#telefono').val() != "" || $('#celular').val() != "")
                    let value = $('#email_address').val();
                    let nombre = $('#nombre').val();
                    let apellido = $('#apellido').val();
                    $('#cardholderName').val(nombre + ' '+apellido);
                    $('#email').val(value);
                    console.log($('#email').val());
                    let longitud = $('#longitud').val();
                    let latitud = $('#latitud').val();
                    $.ajax({
                        url: "https://api.mapbox.com/geocoding/v5/mapbox.places/"+longitud+","+latitud+".json?access_token=pk.eyJ1Ijoiamhvbm1jIiwiYSI6ImNrOXUwdWg0aTFtMjIzZHBqbmJiejEyZWUifQ.E4jyfbchTPlMpfRBTrnyHw",
                        dataType: "json",
                        type: "GET"
                        }).done(function(data) {

                            //console.log(data.features[0].context);

                            console.log(data.features)
                            let country, region, distrito;
                            //$('#direccion').val(data.features[0].place_name);
                            for (let i = 0; i < data.features.length; i++) {

                                let miCadena = data.features[i].id;
                                var divisiones = miCadena.split(".", 1);
                                //console.log(divisiones)
                                if(divisiones == "country"){
                                    //console.log("Pais: "+ data.features[i].text);
                                    country = data.features[i].text;
                                }
                                if(divisiones == "region"){
                                    //console.log("Region: "+ data.features[i].text);
                                    region = data.features[i].text;
                                }
                                if(divisiones == "place"){
                                    //console.log("Distrito: "+ data.features[i].text);
                                    distrito = data.features[i].text;
                                }
                                //console.log("*//////////////////////////////*")

                            }
                            console.log(country,region,distrito);
                            if(country == "Peru"){
                                console.log(region);
                                region == "Calao" ? region = "Puno" : region = region;
                                region == "Lima Province" ? region = "Lima" : region = region;
                                if($('#departamento option:selected').text() == region){
                                    $('.tabs-nav > .active').next('li').find('a').trigger('click');
                                    $('#pasos').empty().append("Paso 2 de 3: Métodos de Pago");
                                }
                                else{

                                        $('#notificacion').empty();
                                        let html = `<div class="notification error closeable margin-top-15">
                                        <p> ¡La ubicacion no pertenece al departamento seleccionado!. Mueva el marcador dentro del departamento seleccionado</p>
                                            </div>`;
                                        $('#notificacion').append(html);

                                }
                            }
                            else{
                                $('#notificacion').empty();
                                    let html = `<div class="notification error closeable margin-top-15">
                                    <p> ¡La ubicacion no pertenece a Perú!. Mueva el marcador dentro de las fronteras de Perú</p>
                                        </div>`;
                                    $('#notificacion').append(html);
                                //console.log("mensaje de error de pais")
                            }
                            //var divisiones = miCadena.split(" ", 1);
                        });
                    //$('.tabs-nav > .active').next('li').find('a').trigger('click');
                    //$('#pasos').empty().append("Paso 2 de 3: Métodos de Pago")
                }

            }
        }
    } 


})
$('.ant').on('click',function(){

    $('.tabs-nav > .active').prev('li').find('a').trigger('click');
    $('#pasos').empty().append("Paso 1 de 3: Datos de Envío")

})

/*var creditcard = document.getElementById('cardNumber');

function onkeyPress(event){
    creditcard.value = creditcard.value.replace(/[a-zA-Z]/g, '');

    //validamos si es american express para esto quitamos todos los espacios en blaco y luego veriricamos que tenga 4, 6 y 5 digitos.
    if(creditcard.value.replace(/ /g, '').match(/\b(\d{4})(\d{6})(\d{5})\b/))
        creditcard.value = creditcard.value
            .replace(/\W/gi, '')//quitamos todos los espacios demas
            .replace(/\b(\d{4})(\d{6})(\d{5})\b/, '$1 $2 $3') //si cumple el formato añadimos 3,6 y 5 digitos
            .trim();
    else //si no es american express entonces es una tarjeta visa o master card
        creditcard.value = creditcard.value
            .replace(/\W/gi, '')
            .replace(/(.{4})/g, '$1 ')
            .trim()
    console.log(creditcard.value.replace(/ /g, ''));
}

creditcard.addEventListener('keypress',onkeyPress);
creditcard.addEventListener('keydown',onkeyPress);
creditcard.addEventListener('keyup',onkeyPress);*/

$("#mounth").each(function() {
    let html;
    html = '';

    //html += '<option>Cerrado</option>';
    for(i = 1; i < 10; i++){
        html += '<option value="0'+i+'">0'+i+'</option>'
    }
    for(i = 10; i < 13; i++){
        html += '<option value="'+i+'">'+i+'</option>'
    }
    $(this).append(html);
});

$("#anio").each(function() {
    var fecha = new Date();
    let html;
    html = '';
    var anio = fecha.getFullYear();
    for(i = 0; i < 6; i++){
        let suma = anio + i;
        html += '<option value="'+suma+'">'+suma+'</option>'
    }
    $(this).append(html);
});
