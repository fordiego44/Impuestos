import Validate from './Validate'
import SchemaValidateContact from './schema/apprasail'

const form = document.getElementById('apprasail')
const validity = new Validate(SchemaValidateContact);

// Activate changes
// form.addEventListener('change', function (e) {
//     validity.validate(e.target.dataset.validate,false, true);
// })

document.getElementById('apprasail-submit').addEventListener('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    let dataForm = validity.validateFormAll(true);

    if (typeof dataForm === 'object') {
        const data = {
            name: `${dataForm['first_name']} ${dataForm['last_name']}`,
            email: dataForm['email_contact'],
            cellphone: dataForm['phone_contact'],
            text: `
            FORMULARIO DE TASACIÓN
              Nombre: ${dataForm['first_name']}
              Apellido: ${dataForm['last_name']}
              Email: ${dataForm['email_contact']}
              Direccion: ${dataForm['address']}
              Localidad: ${dataForm['location']}
              Celular: ${dataForm['phone_contact']}
              Whatsapp: ${dataForm['whatsapp_contact']}
              Tipo de Operacion: ${dataForm['type_operation']}
              Tipo de Propiedad: ${dataForm['type_property']}
              Superficie Total: ${dataForm['suptotal']}
              Superficie Cubierta: ${dataForm['supcub']}
              Superficie Semi Cubierta: ${dataForm['supscub']}
              Cochera: ${dataForm['cochera']}
              Antigüedad: ${dataForm['antiguedad']}
              ARBA: ${dataForm['arba']}
              Expensas: ${dataForm['expensas']}
              Mensaje: ${dataForm['message']}`,
            tags: ['urdapilleta.com.ar']
        };
        //const refProperty = document.querySelector('[name="property_ref"]').value
        //if(refProperty) data.tags.push(refProperty);
        swal({
            type: 'info',
            title: 'Enviando tasación ...',
            showCancelButton: false,
            showConfirmButton: false
        });
        swal.showLoading();
        jQuery.ajax({
            method: "POST",
            url: "/contacto",
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function (e) {
                swal.hideLoading();

                swal({
                    type: 'success',
                    title: 'Tasación Enviada',
                });
                form.innerHTML = '<div class="alert alert-success" role="alert">\n' +
                    '  <h4 class="alert-heading">Genial!</h4>\n' +
                    '  <p>Tu tasación ha sido enviada. Te responderemos a la brevedad.</p>\n' +
                    '  <hr>\n' +
                    '</div>';
            },
            error: function (e) {

                swal.hideLoading();
                swal({
                    type: 'error',
                    title: 'Un error ha ocurrido tu tasación no ha sido enviada',
                });
            }
        })
    }
})
