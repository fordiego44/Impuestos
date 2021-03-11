const PROPERTIES_TYPES_ID = [
    1,
    2,
    3,
    4,
    5,
    6,
    7,
    8,
    9,
    10,
    11,
    12,
    13,
    14,
    15,
    16,
    17,
    18,
    19,
    20,
    21,
    22,
    23,
    24
];

const PROPERTIES_OPERATIONS_ID = [
    1,
    2,
    3
];
// @todo fix deposito
const PROPERTIES_TYPES_SLUG = {
    "terreno": 1,
    "departamento": 2,
    "casa": 3,
    "quinta": 4,
    "oficina": 5,
    "amarra": 6,
    "local": 7,
    "terrenos_comerciales": 8,
    "campo": 9,
    "cochera": 10,
    "hotel": 11,
    "nave industrial": 12,
    "ph": 13,
    "depósito": 14,
    "terrenos_residenciales": 15,
    "baulera": 16,
    "bodegas": 17,
    "fincas": 18,
    "chacra": 19,
    "cama nautica": 20,
    "isla": 21,
    "desconocido": 22,
    "terraza": 23,
    "galpon": 24,
    "propiedades": "propiedades"
};

const PROPERTIES_OPERATIONS_SLUG = {
    'venta': 1,
    'alquiler': 2,
    'alquiler-temporal': 3,
    "urdapilleta": 'urdapilleta'
};


const PROPERTIES_TYPES_KEYS = {
    1: 'terreno',
    2: "departamento",
    3: "casa",
    4: "quinta",
    5: "oficina",
    6: "amarra",
    7: "local",
    8: "terrenos_comerciales",
    9: "campo",
    10: "cochera",
    11: "hotel",
    12: "nave_industrial",
    13: "ph",
    14: "depósito",
    15: "terrenos_residenciales",
    16: "baulera",
    17: "bodegas",
    18: "fincas",
    19: "chacra",
    20: "cama_nautica",
    21: "isla",
    22: "desconocido",
    23: "terraza",
    24: "galpon",
};

const SUITE_KEYS = {
    0: '0-dormitorios',
    1: '1-dormitorios',
    2: '2-dormitorios',
    3: '3-dormitorios',
    4: '4-dormitorios',
    5: '5-dormitorios'
};

const ROOM_KEYS = {
    0: '0-ambientes',
    1: '1-ambientes',
    2: '2-ambientes',
    3: '3-ambientes',
    4: '4-ambientes',
    5: '5-ambientes'
};

const BATHROOM_KEYS = {
    0: '0-banos',
    1: '1-banos',
    2: '2-banos',
    3: '3-banos',
    4: '4-banos',
    5: '5-banos'
};

//@todo Code Operations of Tokkobroaker

const PROPERTIES_OPERATIONS_KEYS = {
    1: 'venta',
    2: 'alquiler',
    3: 'alquiler-temporal'
};

const PROPERTIES_PRICE_USD_KEYS = {

    0: 'precio-0-100000-usd',
    100000: 'precio-100000-200000-usd',
    200000: 'precio-200000-300000-usd',
    300000: 'precio-300000-400000-usd',
    400000: 'precio-400000-500000-usd',
    500000: 'precio-500000-600000-usd',
    600000: 'precio-600000-700000-usd',
    700000: 'precio-700000-usd',

};

const PROPERTIES_PRICE_ARS_KEYS = {

    0: 'precio-0-20000-ars',
    20000: 'precio-20000-30000-ars',
    30000: 'precio-30000-40000-ars',
    40000: 'precio-40000-ars',

};

const propertyTypesSlug = (k) => {
    const d = k.split('-').map(s => PROPERTIES_TYPES_SLUG[s]).join('-')
    return d.split('-').includes('') ? '' : d;
};

const surfaceKey = (k) => `superficie-${k.split('-')[0] || 0}-${k.split('-')[1] || 1000}`;

const roofedSurfaceKey = (k) => `superficie-cubierta-${k.split('-')[0] || 0}-${k.split('-')[1] || 1000}`;

export const keys = {
    bathroomKey: (k) => BATHROOM_KEYS[k] || '',
    roomKey: (k) => ROOM_KEYS[k] || '',
    suiteKey: (k) => SUITE_KEYS[k] || '',
    surfaceKey,
    roofedSurfaceKey,
    operationTypesSlug: (k) => PROPERTIES_OPERATIONS_SLUG[k] || '',
    propertyTypesSlug,
    operationTypesKey: (k) => PROPERTIES_OPERATIONS_KEYS[k] || '',
    priceUsdKey: (k) => PROPERTIES_PRICE_USD_KEYS[k] || '',
    priceArsKey: (k) => PROPERTIES_PRICE_ARS_KEYS[k] || '',
    propertyTypesKey: (k) => PROPERTIES_TYPES_KEYS[k] || '',
    location: (k) => JSON.parse(localStorage.getItem('locations_property'))
        .filter(c => (c.location_name.toLowerCase().includes(k.toLowerCase())))
        .map(d => d.location_id)
        .shift() || '',
    sublocation: (s) => JSON.parse(localStorage.getItem('barrio_property'))
        //  .filter(c => (c.location_id == s))
        .filter(c => (c.name.toLowerCase().includes(k.toLowerCase())))
        .map(d => d.id)
        .shift() || '',
    sublocationTest: (s) => JSON.parse(localStorage.getItem('barrios_property'))
        .filter(c => (c.location_name == s))
        .shift() || '',

    development: (s) => JSON.parse(localStorage.getItem('barrios_development'))
        .filter(c => (c.location_name == s))
        .map(d => d.location_id)
        .shift() || '',
    developmentTest: (s) => JSON.parse(localStorage.getItem('barrios_development'))
        .filter(c => (c.location_name == s))

        .shift() || '',

};
