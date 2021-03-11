import { getPathnameSlugify } from "./decodeSlugify";
import { keys } from "../../dataTokko";
import { each } from "lodash";

export let getParams = () => {
    const queryParams = document.location.search;
    if (document.location.search) {
        const keyRegex = new RegExp('([a-zA-Z]*[^&]*)', 'gi');
        let params = {};
        queryParams.match(keyRegex).map((val) => {
            if (val === '') return;
            if (val.includes('&') || val.includes('?')) {
                val = val.substr(1,);
            }
            let [query, value] = val.split('=');
            Object.assign(params, {
                [decodeURIComponent(query)]: decodeURIComponent(value)
            })
        });
        return params;
    }
    return {};

}

export let appendQuery = (key, value) => {
    if (typeof value === 'undefined') return;
    const baseUrl = `${location.protocol}//${location.host}${location.pathname}`;
    const urlQueryString = document.location.search;
    let newParam = key + '=' + encodeURIComponent(value),
        params = '?' + newParam;
    if (urlQueryString) {
        const keyRegex = new RegExp('([\?&])' + key + '[^&]*', 'gi');
        // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,]+)[^&]*`, 'gi');
        const keyValueQueryRegex = new RegExp(`${key}=([\\d|,]+)[^&]*`, 'gi');
        const regexSolveKeyValue = urlQueryString.match(keyValueQueryRegex);
        const queryStringMatch = (regexSolveKeyValue != null) ? regexSolveKeyValue[0].split('=')[1] : null;
        if (queryStringMatch !== null) {
            let valuesQuery = `${queryStringMatch},${encodeURIComponent(value)}`.split(',').sort((a, b) => {
                return a - b
            }).join(',');
            newParam = `${key}=${valuesQuery}`;
            params = urlQueryString.replace(keyRegex, '$1' + newParam);
        } else {
            if ('&' === urlQueryString[urlQueryString.length - 1]) {
                params = urlQueryString + newParam;
            } else {
                params = urlQueryString + '&' + newParam;
            }
        }
    }
    params = params.replace(/&{2,}/, '&');

    return `${baseUrl}${params}`;
};
export let removeQuerySlugify = (key = '', value = '') =>
    `${location.protocol}//${location.host}/buscar/${changeQueryByType(key, value).join('-en-')}`;

export let appendQuerySlugify = (key = '', value = []) => {
    const baseUrl = `${location.protocol}//${location.host}/buscar`;


    let development = keys.developmentTest(key[3].value)
    if (development) {
        key[2] = { type: 'location', value: development.location_name };
        key[3] = { type: 'sublocation', value: '' }
    }

    let query;
    if (key instanceof Array) {
        key.map((q) => query = changeQueryByType(q.type, q.value, query))


    } else {
        query = changeQueryByType(key, value);

    }
    return `${baseUrl}/${query.join('-en-')}`;
};

export let filterSidebar = (value = []) => {

    const baseUrl = `${location.protocol}//${location.host}/buscar`;


    let query = []
    let result = ''
    if (value.length == 1) {

        let first = changeQueryByType(value[0].type, changeByType(value[0].type, value[0].value, value[0].name));
        return `${baseUrl}/${first.join('-en-')}`;

    } else {
        let first = changeQueryByType(value[0].type, changeByType(value[0].type, value[0].value, value[0].name));

        query.push(first)
        for (let i = 0; i < value.length; i++) {
            if (i > 0) {
                query[i] = changeQueryByType(value[i].type, changeByType(value[i].type, value[i].value), query[i - 1]);
                result = query[i]
            }
        }

        return `${baseUrl}/${result.join('-en-')}`;

    }

};

function changeByType(type = 'undefined', value = '', name = '') {
    let query = ''
    switch (type) {
        case 'tipo_operacion':
            query = keys.operationTypesKey(value)
            break;
        case 'tipo_propiedad':
            query = keys.propertyTypesKey(value)
            break;

        case 'sublocation':
            /*let development = keys.developmentTest(name)
            if (development) {
                query = development.location_name
            } else {
                let t = keys.sublocationTest(name)
                query = t.location_name

            }*/

            break;
        case 'suite':
            query = keys.suiteKey(value)
            break;
        case 'room':
            query = keys.roomKey(value)
            break;
        case 'bathroom':
            query = keys.bathroomKey(value)
            break;
        case 'price':
            query = keys.priceArsKey(value)
            break;
        case 'surface':
            query = keys.surfaceKey(value)
            break;
        case 'roofed_surface':
            query = keys.roofedSurfaceKey(value)
            break;
        default:
            break;
    }
    console.log("LOG", query);
    return query;
}

function changeQueryByType(type = 'undefined', value = '', query = getPathnameSlugify().split('-en-')) {
    console.log('type', type);
    console.log('value', value);
    console.log('query', query);

    switch (type) {
        case 'tipo_operacion':
            switch (query.length) {
                case 0:
                case 1:
                    query = ['propiedades', value.toLowerCase().split(' ').join('-') || 'urdapilleta'];
                    break;
                case 2:
                case 3:
                    query[1] = value.toLowerCase().split(' ').join('-') || 'urdapilleta';
                    if (query[0] == '') query[0] = 'propiedades'
                    break;
                default:
                    break;
            }
            break;
        case 'tipo_propiedad':
            switch (query.length) {
                case 0:
                case 1:
                    query = [value.toLowerCase().split(' ').join('-') || 'propiedades', 'urdapilleta'];
                    break;
                case 2:
                case 3:
                    if (value instanceof Array) {
                        const values = value.join('-');
                        query[0] = values.toLowerCase().split(' ').join('_') || 'propiedades';
                    } else {
                        const removeValue = query[0].split('-con-').filter(s => s.includes(value));
                        if (removeValue.length > 0) {
                            query[0] = removeValue[0].toLowerCase().split('-').filter(s => !s.includes(value)).join('_') || 'propiedades';
                        } else {
                            query[0] = value.toLowerCase().split(' ').join('_') || 'propiedades';
                        }
                    }
                    if (query[1] == '') query[1] = 'urdapilleta'
                    break;
                default:
                    break;
            }
            break;
        case 'location':

            switch (query.length) {
                case 0:
                case 1:
                    query = ['propiedades', 'urdapilleta'];
                    break;
                case 2:
                case 3:
                    query[2] = value || 'ag-pilar';

                    if (query[0] == '') query[0] = 'propiedades';
                    if (query[1] == '') query[1] = 'urdapilleta';
                    break;
                default:
                    break;
            }
            break;
        case 'sublocation':
            switch (query.length) {
                case 3:
                    if (query[2]) {
                        const sublocations = query[2].split('--');
                        console.log('sublocations', sublocations);
                        const l = sublocations.shift();
                        console.log('l', l);
                        if (sublocations.includes(value)) {
                            console.log('l2 ', sublocations.includes(value))
                            query[2] = `${l}${(sublocations.length > 1) ? '--' : ''}${sublocations.filter(s => s != value).join('--')}`;
                        } else {

                            if (value) {
                                console.log('l3 ', sublocations.includes(value))

                                query[2] = `${l}${(sublocations.length > 0) ? `--${sublocations.join('--')}` : ''}--${value}`;

                            } else {
                                console.log('l4 ', sublocations.includes(value))

                                query[2] = `${l}${(sublocations.length > 0) ? `--${sublocations.join('--')}` : ''}`;
                            }
                        }
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'suite':

            switch (query.length) {
                case 3:
                    const suite = query[0].split('-con-').filter(s => !s.includes('dormitorios'));
                    const s = suite.shift();
                    if (value) {
                        query[0] = `${s}${(suite.length > 0) ? `-con-${suite.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[0] = `${s}${(suite.length > 0) ? `-con-${suite.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'room':

            switch (query.length) {
                case 3:
                    const room = query[0].split('-con-').filter(s => !s.includes('ambientes'));
                    const s = room.shift();
                    if (value) {
                        query[0] = `${s}${(room.length > 0) ? `-con-${room.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[0] = `${s}${(room.length > 0) ? `-con-${room.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'bathroom':

            switch (query.length) {
                case 3:
                    const bath = query[0].split('-con-').filter(b => !b.includes('banios'));
                    const b = bath.shift();
                    if (value) {
                        query[0] = `${b}${(bath.length > 0) ? `-con-${bath.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[0] = `${b}${(bath.length > 0) ? `-con-${bath.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'price':

            switch (query.length) {
                case 3:
                    const price = query[1].split('-con-').filter(b => !b.includes('precio'));
                    const p = price.shift();
                    if (value) {
                        query[1] = `${p}${(price.length > 0) ? `-con-${price.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[1] = `${p}${(price.length > 0) ? `-con-${price.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'surface':
            switch (query.length) {
                case 3:
                    const surface = query[0].split('-con-').filter(b => !b.includes('superficie'));
                    const p = surface.shift();
                    if (value) {
                        query[0] = `${p}${(surface.length > 0) ? `-con-${surface.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[0] = `${p}${(surface.length > 0) ? `-con-${surface.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'roofed_surface':
            switch (query.length) {
                case 3:
                    const roofedSurface = query[0].split('-con-').filter(b => !b.includes('cubierta'));
                    const p = roofedSurface.shift();
                    if (value) {
                        query[0] = `${p}${(roofedSurface.length > 0) ? `-con-${roofedSurface.join('-con-')}` : ''}-con-${value}`;
                    } else {
                        query[0] = `${p}${(roofedSurface.length > 0) ? `-con-${roofedSurface.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'apto':
            switch (query.length) {
                case 3:
                    if (value instanceof Array) {
                        const aptoCredit = value.shift();
                        const values = value.join('-');
                        query[0] = values.toLowerCase().split(' ').join('_') || 'propiedades';
                        query[0] = `${query[0]}-con-${aptoCredit}`;
                    } else {
                        const aptoCredit = query[0].split('-con-').filter(b => !b.includes('credito'));
                        const p = aptoCredit.shift();
                        query[0] = `${p}${(aptoCredit.length > 0) ? `-con-${aptoCredit.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        case 'pro':
            switch (query.length) {
                case 3:
                    if (value instanceof Array) {
                        const proCredit = value.shift();
                        const values = value.join('-');
                        query[0] = values.toLowerCase().split(' ').join('_') || 'propiedades';
                        query[0] = `${query[0]}-con-${proCredit}`;
                    } else {
                        const proCredit = query[0].split('-con-').filter(b => !b.includes('profesional'));
                        const p = proCredit.shift();
                        query[0] = `${p}${(proCredit.length > 0) ? `-con-${proCredit.join('-con-')}` : ''}`;
                    }
                    break;
                default:
                    break;
            }
            break;
        default:
            break;
    }
    return query;
}

export let removeQuery = (key, value) => {
    const baseUrl = `${location.protocol}//${location.host}${location.pathname}`;
    const urlQueryString = document.location.search;
    let params = urlQueryString;

    if (urlQueryString) {
        // const keyValueQueryRegex = new RegExp(`(?<=${key}=)([\\d|,|%2B|\\w]+)[^&]*`, 'gi');
        const keyValueQueryRegex = new RegExp(`${key}=([\\d|,|%2B|\\w]+)[^&]*`, 'gi');
        const keyRegex = new RegExp(key + '=' + '[\\d|,|%2B|\\w]*', 'gi');
        const regexResolveKeyValue = urlQueryString.match(keyValueQueryRegex);
        const queryStringMatch = (regexResolveKeyValue != null) ? regexResolveKeyValue[0].split('=')[1] : null;
        if (typeof value === 'undefined') {
            if (urlQueryString.match(keyRegex) !== null) {
                params = urlQueryString.replace(keyRegex, '');
            }
        } else {

            if (queryStringMatch !== null) {
                const valueQuery = queryStringMatch.split(',').filter((val) => {
                    return val !== value;
                }).join(',');
                const replaceValueQuery = (valueQuery === '') ? '' : `${key}=${valueQuery}`;
                params = urlQueryString.replace(keyRegex, replaceValueQuery);
                if (params[params.length - 1] === '&') {
                    params = params.substring(0, params.length - 1);
                }
            } else {

            }
        }
    }
    params = params.replace(/&{2,}/, '&');

    return `${baseUrl}${params}`;
};