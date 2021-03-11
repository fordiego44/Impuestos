let clic = Math.round($('#valor').val());
console.log(clic);

$('#rating-' + clic + '').click();

$('.qualification').on('change', function () {
    console.log($(this).val());
    $('#qualification').val($(this).val());
    let qualification = $('#qualification').val();

    let id = $('#id_company').val()

    $.get('/qualification', { qualification: qualification, id: id }, function (res) {
        console.log(res);
        if (res.status == "201") {
            /*$('#qualify').remove();
            $('#titulo').empty().append('¡Gracias por tu opinion!');*/
            //$('#rating-1').click();
        }
        else {
            //$('#limpiar').empty();
            /*$('#titulo').empty().append('¡Debes Registrarte!');*/
            $('.sign-in').click();

        }
    })
})

$('.like-icon').on('click', function () {
    //console.log($(this).attr('data-id'));
    let user = $(this).attr('data-id');
    if (user) {
        $.get('/like', { user: user }, function (res) {
            console.log(res);
            if (res.status == "200") {
                $(this).click();
                $('.sign-in').click();
                $(this).click();
            }
        })
    }
    
})