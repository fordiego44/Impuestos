import Validate from './Validate'
import SchemaValidateContact from './schema/detailVisita'

const form = document.getElementById('property-contact-agent-form-visita')

const validity = new Validate(SchemaValidateContact);



document.getElementById('contact-agent-button-visita').addEventListener('click', function (e) {
    e.stopPropagation();
    e.preventDefault();
    let dataForm = validity.validateFormAll();
    console.log("dataForm", dataForm);

    if (typeof dataForm === 'object') {
        const valProperty = document.getElementById('property_id').value;
        const data = {
            name: `${dataForm['name-visita']}`,
            email: dataForm['email-visita'],
            text: ` FORMULARIO DE VISITA
                    Dia: ${dataForm['dia-visita']} 
                    Turno: ${dataForm['turno-visita']} 
                    Mensaje: ${dataForm['message-visita']}`,

            cellphone: dataForm['phone-visita'],
            properties: [valProperty],
            tags: ['Solicitud de Visita']
        }
        console.log("DADA", data);

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
