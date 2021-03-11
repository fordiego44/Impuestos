import { BaseElement } from './BaseElement'
import { getParams } from "../actions/UrlQuery";
import { PROPERTIES_TYPES, PROPERTIES_OPERATIONS } from '../services/codeTokko'

export default class LiActive extends BaseElement {

    constructor(id, title, data) {

        super()
        this._id = id
        this.title = title
        this.data = data

    }

    createLiString(type, title, value) {

        return `<div class="property-grid-price remove-filter" data-query="${type}" data-value="${value}" data-action="remove" style="cursor: pointer">
                                <span class="price-prefix" data-query="${type}" data-value="${value}" data-action="remove"></span>
                                <span class="property-price-holder" data-query="${type}" data-value="${value}" data-action="remove"><i class="fa fa-remove" aria-hidden="true"></i> <span class="property-price-number" data-query="${type}" data-value="${value}" data-action="remove">${title}</span></span>
                            </div>`

    }

    getElementString() {
        let liTags = ''
        const { tipo_propiedad, tipo_operacion, sublocation, dormitorios, ambientes, page, location, price_type, price_from, price_to, surface_type, surface_from, surface_to, development } = getParams();
        if (tipo_propiedad) {
            tipo_propiedad.split(',').map((valueQuery) => {
                this.data['property_types'].map((val) => {
                    if (val.id == valueQuery) {
                        liTags += this.createLiString('tipo_propiedad', PROPERTIES_TYPES[val.id], val.id)
                    }
                })
            })
        }

        if (tipo_operacion) {
            tipo_operacion.split(',').map((valueQuery) => {
                this.data['operation_types'].map((val) => {
                    if (val.id == valueQuery) {

                        liTags += this.createLiString('tipo_operacion', PROPERTIES_OPERATIONS[val.id], val.id)

                    }
                })
            })
        }

        if (location) {
            location.split(',').map((valueQuery) => {
                this.data['locations'].map((val) => {
                    if (val.id == valueQuery) {
                        liTags += this.createLiString('location', val.name, val.id)
                    }
                })
            })
        }

        if (development) {
            development.split(',').map((valueQuery) => {
                this.data['development'].map((val) => {
                    if (val.id == valueQuery) {
                        liTags += this.createLiString('development', val.name, val.id)
                    }
                })
            })
        }

        if (sublocation) {
            sublocation.split(',').map((valueQuery) => {
                this.data['sublocations'].map((val) => {
                    if (val.location_id == valueQuery) {
                        liTags += this.createLiString('sublocation', val.name, val.id)

                    }
                })

            })

        }

        if (ambientes) {
            ambientes.split(',').map((valueQuery) => {
                this.data['room_amount'].map((val) => {
                    if (val.id == valueQuery) {
                        liTags += this.createLiString('ambientes', `Ambiente ${val.id}`, val.id)
                    }
                })

            })

        }

        if (dormitorios) {
            dormitorios.split(',').map((valueQuery) => {

                this.data['suite_amount'].map((val) => {
                    if (val.id == valueQuery) {
                        liTags += this.createLiString('dormitorios', `Dormitorio ${val.id}`, val.id)
                    }
                })

            })

        }

        if (page) {
            page.split(',').map((valueQuery) => {
                liTags += this.createLiString('page', `Pagina ${valueQuery}`, valueQuery)

            })

        }

        if (price_from) {
            price_from.split(',').map((valueQuery) => {
                liTags += this.createLiString('price_from', `Precio desde ${valueQuery}`, valueQuery)
            })

        }

        if (price_to) {
            price_to.split(',').map((valueQuery) => {
                liTags += this.createLiString('price_to', `Precio hasta ${valueQuery}`, valueQuery)
            })

        }

        if (price_type) {
            price_type.split(',').map((valueQuery) => {
                liTags += this.createLiString('price_type', `Tipo de precio ${valueQuery}`, valueQuery)
            })

        }

        if (surface_from) {
            surface_from.split(',').map((valueQuery) => {
                liTags += this.createLiString('surface_from', `Superficie desde ${valueQuery}`, valueQuery)
            })

        }

        if (surface_to) {
            surface_to.split(',').map((valueQuery) => {
                liTags += this.createLiString('surface_to', `Superficie hasta ${valueQuery}`, valueQuery)
            })

        }

        if (surface_type) {
            surface_type.split(',').map((valueQuery) => {
                let nameSurface;

                switch (valueQuery) {
                    case 'roofed':
                        nameSurface = 'Cubierta';
                        break;
                    case 'surface':
                        nameSurface = 'Terreno';
                        break;
                    case 'total':
                        nameSurface = 'Total';
                        break;
                    default:
                        nameSurface = 'Desconocido';
                }

                liTags += this.createLiString('surface_type', `Tipo de superficie ${nameSurface}`, valueQuery)
            })

        }

        return liTags;

    }
}
