import Validate from './Validate'
import SchemaValidateContact from './schema/detailProperty'

const form = document.getElementById('property-contact-agent-form')

const validity = new Validate(SchemaValidateContact);



document.getElementById('contact-agent-button').addEventListener('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    let dataForm = validity.validateFormAll();
    if (typeof dataForm === 'object') {
        const valProperty = document.getElementById('property_id').value;
        const data = {
            name: `${dataForm['name']}`,
            email: dataForm['email'],
            text: dataForm['message'],
            cellphone: dataForm['phone'],
            properties: [valProperty],
            tags: ['urdapilleta.com.ar']
        }
        swal({
            type: 'info',
            title: 'Enviando tu Consulta ...',
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
                    title: 'Tu Consulta ha sido Enviada',
                });
                form.innerHTML = '<div class="alert alert-success" role="alert">\n' +
                    '  <h4 class="alert-heading">Genial!</h4>\n' +
                    '  <p>Tu consulta ha sido enviada te responderemos a la brevedad.</p>\n' +
                    '  <hr>\n' +
                    '</div>';
            },
            error: function (e) {

                swal.hideLoading();
                swal({
                    type: 'error',
                    title: 'Un error ha ocurrido tu consulta no ha sido enviada',
                });
            }
        })
    }
})
