export default {
    fields: [
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
            name: 'password',
            message: {
                error: 'Por favor complete su contraseña',
                success: 'Contraseña correctamente completado'
            }
        }
    ]
}
