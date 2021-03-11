export const getQueriesForIndex = () => {

    const typeProperty = document.querySelector('[name="tipo_propiedad"]').value;
    let valTypeProperty = (typeProperty.toLowerCase() == 'casa') ? ['casa', 'ph'] : typeProperty;
    return [
        {
            type: 'tipo_operacion',
            value: document.querySelector('[name="tipo_operacion"]').value
        },
        {
            type: 'tipo_propiedad',
            value: valTypeProperty
        },
        {
            type: 'location',
            value: document.querySelector('[name="location"]').dataset.name
        },

        {
            type: 'sublocation',
            value: document.querySelector('[name="sublocation"]').dataset.name
        }
    ];
}

export const getQueriesList = () => [
    {
        type: 'location',
        value: document.querySelector('[name="location"]').dataset.name
    }
];

export const getQueriesFilter = () => [
    {
        type: 'sublocation',
        value: document.querySelector('[name="sublocation"]').dataset.name
    }
]