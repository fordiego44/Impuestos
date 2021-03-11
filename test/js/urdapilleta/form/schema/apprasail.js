export default {
    fields: [
        {
            rule: '\\w+',
            name: 'first_name',
            message: {
                error: 'Por favor complete el campo con su nombre',
                success: 'Nombre correctamente completado'
            }
        },
        {
            rule: /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
            name: 'email_contact',
            message: {
                error: 'Por favor complete el campo con su email de contacto',
                success: 'Email correctamente completado'

            }
        },
        {
            rule: '\\w+',
            name: 'last_name',
            message: {
                error: 'Por favor complete el campo con su apellido',
                success: 'Apellido correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'phone_contact',
            message: {
                error: 'Por favor complete con su telefono de contacto',
                success: 'Telefono correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'whatsapp_contact',
            message: {
                error: 'Por favor complete con su Whatsapp de contacto',
                success: 'Whatsapp correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'message',
            message: {
                error: 'Por favor complete con algun mensaje',
                success: 'Mensaje correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'type_property',
            message: {
                error: 'Por favor complete con algun Tipo de Propiedad Correcto',
                success: 'Tipo de Propiedad correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'type_operation',
            message: {
                error: 'Por favor complete con algun Tipo de Operación Correcto',
                success: 'Tipo de Operación correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'location',
            message: {
                error: 'Por favor complete la localidad',
                success: 'Localidad correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'address',
            message: {
                error: 'Por favor complete con la dirección',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'supcub',
            message: {
                error: 'Por favor complete la superficie cubierta',
                success: 'Dirección correctamente completado'
            }
        },
         
        {
            rule: '\\w+',
            name: 'supscub',
            message: {
                error: 'Por favor complete la superficie semi cubierta',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'suptotal',
            message: {
                error: 'Por favor complete la superficie total',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'antiguedad',
            message: {
                error: 'Por favor complete la antiguedad',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'cochera',
            message: {
                error: 'Por favor complete la cantidad de cocheras',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'expensas',
            message: {
                error: 'Por favor complete las expensas',
                success: 'Dirección correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'arba',
            message: {
                error: 'Por favor complete el valor de arba',
                success: 'Dirección correctamente completado'
            }
        },
    ]
}
