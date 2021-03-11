export default {
    fields: [
        {
            rule: '\\w+',
            name: 'name',
            message: {
                error: 'Por favor complete el campo con su nombre',
                success: 'Nombre correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'email',
            message: {
                error: 'Por favor complete el campo con su email de contacto',
                success: 'Email correctamente completado'

            }
        },
        {
            rule: '\\w+',
            name: 'phone',
            message: {
                error: 'Por favor complete su telefono de contacto',
                success: 'Telefono correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'message',
            message: {
                error: 'Por favor complete con algun mensaje',
                success: 'Mensaje correctamente completado'
            }
        }
    ]
}
