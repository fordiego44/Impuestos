/*$('.chosen-select').on('change',function(){
    let id = $(this).val();
    console.log(id);
    $.get('/change',{id:id},function(res){
        console.log(res);
        $.each(res.data,function(index,value){
            $('#precio').empty();
            $('#precio').append('<strong> Precio:</strong> S/. ' +value.price+'');
            if(value.image == null){
                //$("#imagen").attr("src","/images/default.jpg");
            }
            else{
                $("#imagen").attr("src","/images/"+value.image+"");
            }

            //$("#imagen").attr("src","/images/2212.png");
        })
        
    })
    
})*/

$('.change').on('click', function () {
    let id = $(this).attr('data-id');
    console.log("test");
    var zoomImage = $('img#imagen');

    $.get('/change', { id: id }, function (res) {

        $.each(res.data, function (index, value) {
            $('.precio').empty();
            $('.precio').append(' S/. ' + value.price.toFixed(2) + '');
            $('#variation').val(value.id);

            if (value.image == null) {
                //$("#imagen").attr("src","/images/default.jpg");
            }
            else {
                $("#imagen").attr("src", "/images/" + value.image + "");
                $('.zoomContainer').remove();
                zoomImage.removeData('elevateZoom');
                zoomImage.attr('src', '/images/' + value.image);
                zoomImage.data('zoom-image', '/images/' + value.image);
                $('img#imagen').elevateZoom();
                $('img#imagen .zoomContainer .zoomWindowContainer div').attr("src", "/images/" + value.image + "");
            }
        })

    })

})

$('#pdf').on('click', function () {
    console.log('hola');
    let id = "3";
    //window.open( '/acta/7/2020-05-13%2017:47:41',"_blank").focus();
    window.open('/ticket', "_blank").focus();

    //window.open( '/acta/'+id+'/'+date+'',"_blank").focus();
})