import { BaseElement } from "../../user-interface/BaseElement";
import { PROPERTIES_OPERATIONS, PROPERTIES_TYPES } from "../../services/codeTokko";
import { keys } from "../../dataTokko";
import { getParams } from "../actions/querySluglify";
export default class LiActive extends BaseElement {

    constructor(id, title, filters) {

        super()
        this._id = id
        this.title = title
        this.data = filters

    }

    createLiString(type, title, value, remove) {


        return `<a href="#" class='property-grid-price remove-filter' data-remove="${remove}" data-query="${type}" data-value="${value}" data-action="remove">${title} <i class="fa fa-close"></i> </a>`

    }

    getElementString() {
        const { page, dev_id, sortby } = getParams();
        // if(sortby) document.getElementById('sort-properties').value = sortby;


        let liTags = '';
        const params = this.data;
        params.map(q => {

            q.map(query => {
                switch (query.type) {
                    case 'tipo_propiedad':
                        query.value.split('-').map((q) => {
                            Array.from(document.querySelectorAll('.propertyType'))
                                .map(elem => elem.dataset.id == q && elem.parentNode.removeChild(elem))
                            liTags += this.createLiString('tipo_propiedad',
                                PROPERTIES_TYPES[q],
                                keys.propertyTypesKey(q),
                                keys.propertyTypesKey(q));
                        })
                        break;
                    case 'tipo_operacion':
                        Array.from(document.querySelectorAll('.operationType'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('tipo_operacion',
                            PROPERTIES_OPERATIONS[query.value],
                            keys.operationTypesKey(query.value),
                            'urdapilleta');
                        break;
                    case 'dormitorios':
                        Array.from(document.querySelectorAll('.propertySuite'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('suite',
                            `${query.value == 5 ? '+' : ''}${keys.suiteKey(query.value).split('-').join(' ')}`,
                            query.value,
                            '');
                        break;
                    case 'banios':
                        Array.from(document.querySelectorAll('.propertyBathroom'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('bathroom',
                            `${query.value == 5 ? '+' : ''}${keys.bathroomKey(query.value).split('-').join(' ')}`,
                            query.value,
                            '');
                        break;
                    case 'ambientes':
                        Array.from(document.querySelectorAll('.propertyRoom'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('room',
                            `${query.value == 5 ? '+' : ''}${keys.roomKey(query.value).split('-').join(' ')}`,
                            query.value,
                            '');
                        break;
                    case 'precio_usd':
                        Array.from(document.querySelectorAll('.propertyPriceUsd'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('price',
                            keys.priceUsdKey(query.value).split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'precio_ars':
                        Array.from(document.querySelectorAll('.propertyPriceArs'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('price',
                            keys.priceArsKey(query.value).split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'roofed_surface':
                        Array.from(document.querySelectorAll('.propertyRoofedSurface'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('roofed_surface',
                            keys.roofedSurfaceKey(query.value).split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'surface':
                        Array.from(document.querySelectorAll('.propertySurface'))
                            .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        liTags += this.createLiString('surface',
                            keys.surfaceKey(query.value).split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'apto':
                        // Array.from(document.querySelectorAll('.propertySurface'))
                        //     .map(elem => elem.dataset.id == query.value && elem.parentNode.removeChild(elem));
                        // liTags += this.createLiString('surface',
                        //     keys.surfaceKey(query.value).split('-').join(' '),
                        //     query.value,
                        //     '');
                        liTags += this.createLiString('apto',
                            query.value.split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'pro':

                        liTags += this.createLiString('pro',
                            query.value.split('-').join(' '),
                            query.value,
                            '');
                        break;
                    case 'location':
                        /*
    const locationSearch = document.getElementById('data-location-search');
    if (locationSearch) {
        const {
            location_id: id,
            location_name: name,
            short_name: fullname
        } = JSON.parse(localStorage.getItem('locations_property'))
            .filter(c => (c.location_id == query.value))[0];
 
        let fullname = 'Argentina | G.B.A. Zona Norte | Pilar'
        locationSearch.value = 'Argentina | G.B.A. Zona Norte | Pilar';
        locationSearch.dataset.id = '25127';
        locationSearch.dataset.name = 'ag-pilar';
        liTags += this.createLiString('location', fullname, query.value, 'ag-pilar');
 
        if (query.sublocations) {
            query.sublocations.map(s => {
                const sublocationData = keys.sublocation(s)
                if (sublocationData) {
                    Array.from(document.querySelectorAll('.propertySublocation'))
                        .map(elem => elem.dataset.id == sublocationData.location_id && elem.parentNode.removeChild(elem));
                    liTags += this.createLiString('sublocation',
                        sublocationData.short_name.split(' | ').pop(),
                        sublocationData.location_id,
                        sublocationData.location_name);
                }
            })
        }
    }*/

                        break;

                    case 'development':
                        const locationSearch1 = document.getElementById('data-location-search');

                        if (locationSearch1) {
                            const {
                                location_id: id,
                                location_name: name,
                                title: fullname

                            } = JSON.parse(localStorage.getItem('locations_development'))
                                .filter(c => (c.location_id == query.value))[0];
                            locationSearch1.value = fullname;
                            locationSearch1.dataset.id = id;
                            locationSearch1.dataset.name = name;

                            liTags += this.createLiString('location', fullname, query.value, 'ag-pilar');
                            //liTags += this.createLiString('location', fullname, query.value, 'ag-pilar-buenos-aires');

                            if (query.sublocations) {
                                query.sublocations.map(s => {
                                    const sublocationData = keys.sublocation(s)
                                    if (sublocationData) {
                                        Array.from(document.querySelectorAll('.propertySublocation'))
                                            .map(elem => elem.dataset.id == sublocationData.location_id && elem.parentNode.removeChild(elem));
                                        liTags += this.createLiString('sublocation',
                                            sublocationData.short_name.split(' | ').pop(),
                                            sublocationData.location_id,
                                            sublocationData.location_name);
                                    }
                                })
                            }
                        }
                        break;
                    default:
                        break;
                }
            })

        });

        if (dev_id) {
            dev_id.split(',').map((valueQuery) => {
                liTags += this.createLiString('dev_id', `Emprendimiento ${document.getElementById('dev_id_value').value}`, valueQuery)
            })
        }
        if (sortby) {
            sortby.split(',').map((valueQuery) => {
                liTags += this.createLiString('sortby', `Ordenar por ${sortby}`, valueQuery)
            })
        }


        return liTags;

    }
}
