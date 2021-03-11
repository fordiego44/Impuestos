//$('.boton_secundario').hide();
    $('.cards_customer').on('click',function(){
        $('.securityCode_prueba').val('');
		
        
    })
    $('#newCart').on('click',function(){
        $('#cardNumber').val('');
        $('#cardExpirationMonth').val('');
        $('#cardExpirationYear').val('');
        $('#securityCode').val('');
        $('#docNumber').val('');
        $('#cardholderName').val('');
        $('#payment_method_id').val('');
		$('#checkboxes-mercado').show();
        $("#chech-h").prop("checked", false);
        //$('.boton_secundario').hide();
    })

    $('.boton_secundario').on('click',function(){
        let id = $(this).attr('data-id');
        let cvv = $("#securityCode_prueba-"+id).val();
        Swal.fire({
            title: '¡Comprobando CVV de la tarjeta!',
            html: 'Espere un momento',// add html attribute if you want or remove
            allowOutsideClick: false,
            allowEscapeKey : false,
            //timer: 3000,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
        });
        $('#checkboxes-mercado').hide();
        $("#chech-h").prop("checked", false);
        //let id = $(this).val();
        
        $.get('/card',{id:id,cvv:cvv},function(res){
            //console.log(res.card.number);
            //console.log(res.card);
            if(res.status == 200){
                console.log('bien');
                $('#cardNumber').val(res.card.number);
                $('#cardExpirationMonth').val(res.card.mounth);
                $('#cardExpirationYear').val(res.card.year);
                $('#securityCode').val(res.card.cvv);
                $('#docNumber').val(res.card.document);
                $('#cardholderName').val(res.card.name);
                $('#payment_method_id').val(res.card.type_card);
                //$('#installments').val(value.type_card);
                $('#docType option[value="'+res.card.type_document+'"]').attr("selected",true);
                //$('#installments option[value="1"]').attr("selected",true);
                $('#installments').prepend("<option selected value='1'></option>");
                $('#type_card option[value="'+res.card.credeb+'"]').attr("selected",true);
                //console.log(res);
                //swal.close();
                $('#pagar').click();
                
            }else{
                console.log('mal');
                swal.close();
                Swal.fire({
                    icon: 'error',
                    title: '¡CVV Incorrecto!',
                    text: 'Vuelve a ingresar el CVV insertado',
                  })
            }
   

        })
        //$('.boton_secundario').show();*/
        console.log(id,cvv);
    })