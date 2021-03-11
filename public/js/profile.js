$(document).ready(function(){


 /* document.getElementById("first").innerHTML = "Hola Marte!!!!";
  document.getElementById("image").src = "entrada.jpg";*/

  const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

  // Escuchar cuando cambie
  $seleccionArchivos.addEventListener("change", () => {
  // Los archivos seleccionados, pueden ser muchos o uno
    const archivos = $seleccionArchivos.files;
  // Si no hay archivos salimos de la función y quitamos la imagen
    let direcciondire = $('#imagen').val();
    console.log(direcciondire);

    if (!archivos || !archivos.length) {
      $imagenPrevisualizacion.src = direcciondire;
      return;
    }
  // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    const primerArchivo = archivos[0];
  // Lo convertimos a un objeto de tipo objectURL
    const objectURL = URL.createObjectURL(primerArchivo);
    console.log(objectURL);
  // Y a la fuente de la imagen le ponemos el objectURL
    $imagenPrevisualizacion.src = objectURL;
    });

    $('#open').change(function(){

        //console.log("cambio");
        let estado;
        if( $(this).is(':checked'))
        {
          estado=1;
          //console.log("checked");
        }
        else
        {
          estado=0;
          //console.log("unchecked");
        }
        $.get('/state',{estado:estado},function(res){

            //console.log(res.sucess);

        });


    })

    /*function gallery(){
      $.get('/galeria',function(res){

        $('#gallery').empty();
        console.log(res);
        $.each(res.galeria,function(index,value){
             $('#gallery').append(`

             <div class="col-lg-3 col-md-6">
             <div class="dashboard-stat">
                <img src="/images/${value.image}" alt="">

                <div class="dashboard-stat-content">
                  <!--<a type="button" href="#" class ="a-gallery">Eliminar</a>-->
                  <a class="a-gallery eliminar-item" data-id_image="${value.image}">Eliminar</a>
                </div>

             </div>
           </div>

             `);
        });
      });
    }*/
    $('#days-edit').on('click',function(){

      console.log("click");
      let monday1 = $('#monday1').val();
      let monday2 = $('#monday2').val();
      let tuesday1 = $('#tuesday1').val();
      let tuesday2 = $('#tuesday2').val();
      let wednesday1 = $('#wednesday1').val();
      let wednesday2 = $('#wednesday2').val();
      let thursday1 = $('#thursday1').val();
      let thursday2 = $('#thursday2').val();
      let friday1 = $('#friday1').val();
      let friday2 = $('#friday2').val();
      let saturday1 = $('#saturday1').val();
      let saturday2 = $('#saturday2').val();
      let sunday1 = $('#sunday1').val();
      let sunday2 = $('#sunday2').val();
      let id = $('#id').val();

      let data = {monday1:monday1,
                  monday2:monday2,
                  tuesday1:tuesday1,
                  tuesday2:tuesday2,
                  wednesday1:wednesday1,
                  wednesday2:wednesday2,
                  thursday1:thursday1,
                  thursday2:thursday2,
                  friday1:friday1,
                  friday2:friday2,
                  saturday1:saturday1,
                  saturday2:saturday2,
                  sunday1:sunday1,
                  sunday2:sunday2};
      console.log(data);
      $.get('/days',{id:id,monday1:monday1,
        monday2:monday2,
        tuesday1:tuesday1,
        tuesday2:tuesday2,
        wednesday1:wednesday1,
        wednesday2:wednesday2,
        thursday1:thursday1,
        thursday2:thursday2,
        friday1:friday1,
        friday2:friday2,
        saturday1:saturday1,
        saturday2:saturday2,
        sunday1:sunday1,
        sunday2:sunday2},
        function(res){
          console.log(res.sucess);
          location.reload();
        }
      );

    });

    $('.exportar-resumen').on('click',function(){
        console.log('CLICK PRUEBA');

        let id = 'ayda';
        let date = 'date';
        window.open( '/acta/'+id+'/'+date+'',"_blank").focus();
    })

    $('#edit-profile').on('submit', function(event){
      Swal.fire({
        title: '¡Procesando datos ingresados!',

        allowOutsideClick: false,
        allowEscapeKey : false,
        onBeforeOpen: () => {
            Swal.showLoading()
        },
        });
      event.preventDefault();
      var form_url= $(this).attr('action'),
      form_data=new FormData(this);


      if($('#phone').val() != "" || $('#cellphone').val() != ""){

        let file=$('#seleccionArchivos').val();
        form_data.append('file', file);
        let id=$('#id').val();
        form_data.append('id', id);
        let dni=$('#dni').val();
        form_data.append('dni', dni);
        let ruc=$('#ruc').val();
        form_data.append('ruc', ruc);

        let name=$('#first-name').val();
        form_data.append('name', name);

        let company=$('#company').val();
        form_data.append('company', company);

        let lastname=$('#last-name').val();
        form_data.append('lastname', lastname);

        let department=$('#department_id').val();
        form_data.append('department', department);

        let province=$('#province_id').val();
        form_data.append('province', province);

        let district=$('#district_id').val();
        form_data.append('district', district);

        let phone=$('#phone').val();
        form_data.append('phone', phone);

        let cellphone=$('#cellphone').val();
        form_data.append('cellphone', cellphone);

        let description=$('#description').val();
        form_data.append('description', description);

        $.ajax({
          url: form_url,
          method:"POST",
          data:form_data,
          dataType:"json",
          processData: false,
          contentType: false,
          success:function(res)
          {
              // console.log(res.recenGenerate[0].id);
              console.log(res.user);
              Swal.fire({
                position: 'center',
                icon: 'success',
                title: '¡Datos guardados exitosamente!',
                showConfirmButton: false,
                timer: 1500
              })
              //location.reload();
        }
        });
      }
      else{
        $('#phone').css("border-color", "#F9B314");
        $('#cellphone').css("border-color", "#F9B314");
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: '¡Debe completar el campo telefónico o número de celular!'
        })
      }




    })






});
