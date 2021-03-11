//@todo Decode Slugify of pathname to object or query params
import { keys } from "../../dataTokko";
import { getParams } from "./querySluglify";

export const getPathnameSlugify = () => (
    (document.location.pathname.split('/buscar/').length > 1)
        ? document.location.pathname.split('/buscar/')[1] : '');

function getValuesOfLink(link = '') {

    // const d = getParams();


    if (!['', 'urdapilleta'].includes(link) && keys.operationTypesSlug(link)) {

        return {
            type: 'tipo_operacion',
            value: keys.operationTypesSlug(link)
        }

    } else if (!['', 'propiedades'].includes(link) && keys.propertyTypesSlug(link)) {

        return {
            type: 'tipo_propiedad',
            value: keys.propertyTypesSlug(link)
        }

    } else if (link.includes('dormitorios')) {


        return {

            type: 'dormitorios',
            value: link.split('-').shift()

        }

    } else if (link.includes('banios')) {

        return {

            type: 'banios',
            value: link.split('-').shift()

        }

    } else if (link.includes('ambientes')) {

        return {

            type: 'ambientes',
            value: link.split('-').shift()

        }

    } else if (link.includes('precio') && link.includes('usd')) {

        return {

            type: 'precio_usd',
            value: link.split('-')[1] || 0

        }

    } else if (link.includes('precio') && link.includes('ars')) {

        return {

            type: 'precio_ars',
            value: link.split('-')[1] || 0

        }

    } else if (link.includes('cubierta')) {

        return {

            type: 'roofed_surface',
            value: `${link.split('-')[2]}-${link.split('-')[3]}` || 0

        }

    } else if (link.includes('superficie')) {

        return {

            type: 'surface',
            value: `${link.split('-')[1]}-${link.split('-')[2]}` || 0

        }

    } else if (link.includes('credito')) {

        return {

            type: 'apto',
            value: `${link}` || 0

        }

    } else if (link.includes('profesional')) {

        return {

            type: 'pro',
            value: `${link}` || 0

        }

    }

    const sublocations = link.split('--');

    const l = sublocations.shift();


    if (!['', 'ag-pilar'].includes(l) && keys.location(l)) {
        //if (!['', 'ag-pilar-buenos-aires'].includes(l) && keys.location(l)) {

        const locations = {
            type: 'location',
            sublocations: [],
            value: keys.location(l)
        }
        if (sublocations) sublocations.map(s => locations.sublocations.push(keys.location(s)));
        return locations;
    } else if (keys.development(l)) {

        const development = keys.development(l);
        const locations = {
            type: 'development',
            sublocations: [],
            value: keys.development(l)
        }
        if (sublocations) sublocations.map(s => locations.sublocations.push(keys.development(s)));
        return locations;

    } else {

        return {
            type: '',
            value: ''
        }
    }
    //@todo put if sublocation

}

export const decodeSlugify = (pathname = getPathnameSlugify()) =>
    pathname
        .split('-en-')
        .map((v) => v.split('-con-')
            .map(s => getValuesOfLink(s)));

export const saveDecodeSlugify = (queries = decodeSlugify()) =>
    sessionStorage.setItem("params_url", JSON.stringify(queries)) || queries;

export const decodeSlugifyToParams = (queries = saveDecodeSlugify()) =>
    queries
        .map(query => `${query.type}=${query.value}`)
        .join('&');
