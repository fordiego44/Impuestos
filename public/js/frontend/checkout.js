let data = JSON.parse(localStorage.getItem("checkout"));
console.log(data);

function total(){
    let data = JSON.parse(localStorage.getItem("checkout"));
    let total = 0;
    let bandera = 0;
  
    if(data != null && Object.entries(data).length != 0){
        for(i=0; i<data.length; i++){
          
                bandera=1;
                total=total+data[i].subtotal;
            
        }
        if(bandera == 0){
            let html = `<tr>
                        <td style="text-align:center;background-color:white;">
                            No hay ningún producto.
                        </td>
                    </tr>`
            $('#tBodyTotal').empty().append(html);
        }
        else{
            let html = `<tr>
                        <td style="text-align:center;background-color:white;">
                            
                        <div class="boxed-widget opening-hours summary margin-top-0">
                            <h3 class = "margin-bottom-0 padding-bottom-0"><i class="fa fa-calendar-check-o"></i> S/.${total.toFixed(2)}</h3>
                            

                        </div>
            
                        </td>
                    </tr>`
            $('#tBodyTotal').empty().append(html);
        }
        
    }
    else{
        let html = `<tr>
                        <td style="text-align:center;background-color:white;">
                            No hay ningún producto.
                        </td>
                    </tr>`
        $('#tBodyTotal').empty().append(html);
    } 
}
function setCheckoutHTML() {
    //localStorage.clear();
    let data = JSON.parse(localStorage.getItem("checkout"));
    console.log(data);
    let bandera=0;
    if(data != null && Object.entries(data).length != 0){
       
        let html = [];
    
        for (var i = 0; i < data.length; i++) {
            
                bandera=1;
                html[i] = `
                <tr id="fila-${i}" data-id="${i}"> 

                    <td  class="column-2 seccion-borrar" style="text-align: center;background-color:white;">
                        
                        <button class="button delete" data-id="${i}"style="width:58px;font-size: 22px;border-radius: 5px;"><i class="fa fa-trash-o"></i></button>
                               
                    </td>
                    
                    <td  class="column-1">
                        <div class="dashboard-list-box invoices with-icons" style="border-bottom: none; display:flex;">
                            <ul>
                                
                                <li> 
                                    <i class="list-box-icon sl sl-icon-basket"> </i>
                                    
                                    <div class="text-checkout">`;
                                    
                
                                    if(data[i].attribute_name == "" && data[i].variation_name == ""){
                                        html[i]+= `<strong>${data[i].nombre}</strong>`;
                                    }else{
                                        html[i]+= `<strong>${data[i].nombre} - ${data[i].attribute_name} - ${data[i].variation_name}</strong>`;
                                    }
                
                html[i]+=  `
                                    <ul>
                                        <li><strong>Precio:</strong> S/.${parseFloat(data[i].price).toFixed(2)}</li>
                                        <li><strong>Tiempo de entrega:</strong> ${data[i].time_delay}</li>
                                        <li><strong>Tienda:</strong> ${data[i].company}</li>
                                    
                                
                                    </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td  class="column-2" style="text-align: center">
                        
                
                            <div class="plusminus horiz">`;
                    if(data[i].cant < 2){
                        html[i]+=  `<button class="dismi" data-id="${i}" disabled ></button>`;
                    }
                    else{
                        html[i]+=  `<button class="dismi" id="fallo" data-id="${i}" ></button>`;
                    }
                    html[i]+=  `
                                
                                <input class="input-cant" id="input-${i}" data-id="${i}" type="number" readonly name="slot-qty" value="${data[i].cant}" min="1" max="99">
                                <button class="aument" data-id="${i}"></button> 
                            </div>
                            
                            
                    
                    </td> 
                    <td class="column-2 seccion-borrar" style="text-align: center;background-color:white;">
                        
                        <div class="seccion-total">
                          S/.${data[i].subtotal.toFixed(2)}
                        </div>
                        
                    </td>
                    <td class="column-2 deleteMobile" style="text-align: center;background-color:white;">
                        <div class="col-md-12">
                            
                            <div class="seccion-total" style="text-align:center;">
                                    
                                    
                                    <div style="display:inline-block !important;width:70%;margin-right: 15px;text-align: center;padding-left: 80px;">
                                        <p>S/.${data[i].subtotal.toFixed(2)}</p>
                                    </div>
                                    <div style="display:inline-block !important;width:20%;margin:0px auto !important;">
                                        <button class="button delete" data-id="${i}"style="width:58px;font-size: 22px;border-radius: 5px;"><i class="fa fa-trash-o"></i></button>
                                    </div>
                            </div>
                        </div>
                    </td>  
                   
                </tr>`;
            
        }
        if(bandera==0){
            let mensaje= `<tr> 
                        
            <td  class="column-1" colspan="4" align="center" style="text-align: center;background-color:white;    padding: 14px !important;">
                <strong style="font-weight:600;">No tienes productos de esta tienda. <a style="text-decoration:underline;" href="/mapa">Seguir comprando.</a></strong>       
            </td>
        
        </tr>`;
            $('#tBodyCheckout').empty().append(mensaje);
        }
        else{
            $('#tBodyCheckout').empty().append(html);
        }
       
        
    }
    else{
        let mensaje=`<tr> 
                        
        <td  class="column-2" colspan="4" align="center" style="text-align: center;background-color:white;    padding: 14px !important;">
            <strong style="font-weight:600;">No existen productos en tu carrito de compra. <a style="text-decoration:underline;" href="/mapa">Seguir comprando.</a></strong>       
        </td>
    
    </tr>`;
        $('#tBodyCheckout').empty().append(mensaje);
    }
    
    

}

setCheckoutHTML();
total();
function reconteo(){
    let data_ = JSON.parse(localStorage.getItem('checkout')); 
			let suma =0; 
            data_.forEach(element => {
                suma +=  parseInt(element.cant) 
            });
            $('.qtyTotal').text(suma);  
}
$('#image').on('change',function(){
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

$("#table-products").on('click','.delete',function(){
    Swal.fire({
        title: '¿Deseas eliminar el producto?',
        text: "¡El producto se eliminara de tu carrito!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminar'
      }).then((result) => {
        if (result.value) {
            let data = JSON.parse(localStorage.getItem("checkout"));
            console.log(JSON.parse(localStorage.getItem("checkout")));
            let i= $(this).attr("data-id");
            data.splice(i,1)
            localStorage.setItem("checkout", JSON.stringify(data));
            console.log(JSON.parse(localStorage.getItem("checkout")));
            $('#tBodyCheckout').empty();
            setCheckoutHTML();
            reconteo();
            total();
            
            
        }
      })
    /**/
})


$("#table-products tbody").on('click','tr .dismi',function(){
//$('.dismi').on('click',function(){
    
    let data = JSON.parse(localStorage.getItem("checkout"));
    let i= $(this).attr("data-id");
    
        data[i].cant --;
        data[i].subtotal = data[i].cant * data[i].price;
        console.log(data[i].subtotal);
        //$('#subtotal-'+i).empty().append("S/."+data[i].subtotal+".00");
        localStorage.setItem("checkout", JSON.stringify(data));
        $('#tBodyCheckout').empty();
        setCheckoutHTML();
        reconteo();
        total();
    //console.log($('#input-'+i).val())
})
$(".dismi").on('click',function(){
    //$('.dismi').on('click',function(){
        
        let data = JSON.parse(localStorage.getItem("checkout"));
        let i= $(this).attr("data-id");
        
            data[i].cant --;
            data[i].subtotal = data[i].cant * data[i].price;
            console.log(data[i].subtotal);
            //$('#subtotal-'+i).empty().append("S/."+data[i].subtotal+".00");
            localStorage.setItem("checkout", JSON.stringify(data));
            $('#tBodyCheckout').empty();
            setCheckoutHTML();
            reconteo();
            total();
        //console.log($('#input-'+i).val())
    })
$("#table-products").on('click','.aument',function(){
//$('.aument').on('click',function(){
    
    let data = JSON.parse(localStorage.getItem("checkout"));
    let i= $(this).attr("data-id");
    data[i].cant ++;
    data[i].subtotal = data[i].cant * data[i].price;
    //$('#subtotal-'+i).empty().append("S/."+data[i].subtotal+".00");
    localStorage.setItem("checkout", JSON.stringify(data));
    $('#tBodyCheckout').empty();
    setCheckoutHTML();
    reconteo();
    total();
})

$("#table-products").keyup('.input-cant',function(){
    if($(this).val() < 1){
        $(this).val(1);   
    }
    else{
        if($(this).val() > 99){
            $(this).val(99);
        }
    }
    let data = JSON.parse(localStorage.getItem("checkout"));
    let i= $(this).attr("data-id");
    data[i].cant=$(this).val();
    data[i].subtotal = data[i].cant * data[i].price;
    $('#subtotal-'+i).empty().append("S/."+data[i].subtotal+".00");
    localStorage.setItem("checkout", JSON.stringify(data));
    reconteo();
    total();
    
});

$('#checkout-final').on('click',function(){
   
    let data = JSON.parse(localStorage.getItem("checkout"));
    console.log(data);
    let bandera = 0;
    let total = 0;
  
    
        if(data != null && Object.entries(data).length != 0){
            bandera=1;
           
        }
    
    if(bandera == 0){
        $('.message-data').empty().append(`<div class="notification error closeable">
        <p> <i class="fa fa-times-circle"></i>    No hay productos en tu carrito. <a style="text-decoration:underline;" href="/mapa">Añadir</a></p>
        
    </div>`);
    }
    else{
      
            window.location='/facturation';
    }
 
    
})


