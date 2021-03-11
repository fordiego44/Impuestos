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
            name: 'password',
            message: {
                error: 'Por favor complete el campo con su contraseña',
                success: 'Contraseña correctamente completado'
            }
        },
        {
            rule: '\\w+',
            name: 'password_confirm',
            message: {
                error: 'Por favor complete el campo con su cofirmar contraseña',
                success: 'Confirmar contraseña correctamente completado'
            }
        },

    ]
}
