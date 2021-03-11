export default {
    fields: [
        {
            rule: '\\w+',
            name: 'name-visita',
            message: {
                error: 'Por favor complete el campo con su nombre',
                success: 'Nombre correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'email-visita',
            message: {
                error: 'Por favor complete el campo con su email de contacto',
                success: 'Email correctamente completado'

            }
        },
        {
            rule: '\\w+',
            name: 'phone-visita',
            message: {
                error: 'Por favor complete su telefono de contacto',
                success: 'Telefono correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'message-visita',
            message: {
                error: 'Por favor complete con algun mensaje',
                success: 'Mensaje correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'dia-visita',
            message: {
                error: 'Por favor complete con algun mensaje',
                success: 'Dia correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'turno-visita',
            message: {
                error: 'Por favor complete con algun mensaje',
                success: 'Turno correctamente completado'
            }
        }
    ]
}
