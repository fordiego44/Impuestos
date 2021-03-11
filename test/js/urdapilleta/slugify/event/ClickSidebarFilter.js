import { appendQuerySlugify, appendQuery, filterSidebar } from "../actions/querySluglifyNew";
import { keys } from "../../dataTokko";
import { removeQuery } from "../../actions/UrlQuery";

export default class EventHandler {

    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)
    }
    propertyType(elem) {

        const { dataset: { id } } = elem;
        if (3 == id) {
            const values = [];
            values.push(keys.propertyTypesKey(13), keys.propertyTypesKey(3))
            window.location.href = appendQuerySlugify('tipo_propiedad', values);
        } else {
            window.location.href = appendQuerySlugify('tipo_propiedad', keys.propertyTypesKey(id));

        }

    }
    propertySuite(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('suite', keys.suiteKey(id));
        window.location.href = d;


    }
    propertyRoom(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('room', keys.roomKey(id));
        window.location.href = d;

    }
    propertyBathroom(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('bathroom', keys.bathroomKey(id));
        window.location.href = d;

    }
    propertySurface(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('surface', keys.surfaceKey(id));
        window.location.href = d;
        // window.location.href = d;

    }
    propertyRoofedSurface(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('roofed_surface', keys.roofedSurfaceKey(id));
        window.location.href = d;
        // window.location.href = d;

    }
    aptoCredit(elem) {

        const { dataset: { id } } = elem;
        const values = ['apto-credito'];

        if (3 == id) {

            const d = appendQuerySlugify('apto', [...values, keys.propertyTypesKey(13), keys.propertyTypesKey(3)]);
            window.location.href = d;


        } else {
            const d = appendQuerySlugify('apto', [...values, keys.propertyTypesKey(id)]);
            window.location.href = d;

        }

    }
    proCredit(elem) {

        const { dataset: { id } } = elem;
        const values = ['apto-profesional'];

        if (3 == id) {

            const d = appendQuerySlugify('pro', [...values, keys.propertyTypesKey(13), keys.propertyTypesKey(3)]);
            window.location.href = d;


        } else {
            const d = appendQuerySlugify('pro', [...values, keys.propertyTypesKey(id)]);
            window.location.href = d;

        }

        // const d = appendQuerySlugify('pro', 'con-pro-credito');
        // console.log(d);

        // window.location.href = d;
        // window.location.href = d;

    }
    operationType(elem) {

        const { dataset: { id } } = elem;
        window.location.href = appendQuerySlugify('tipo_operacion', keys.operationTypesKey(id));

    }
    propertyPriceUsd(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('price', keys.priceUsdKey(id));
        window.location.href = d;

    }
    propertyPriceArs(elem) {

        const { dataset: { id } } = elem;
        const d = appendQuerySlugify('price', keys.priceArsKey(id));
        window.location.href = d;
        // window.location.href = d;

    }
    sublocation(elem) {
        const { dataset: { id } } = elem;
        const sublocationData = keys.sublocation(id);
        if (sublocationData) {
            window.location.href = appendQuerySlugify('sublocation', sublocationData.location_name);
        }
    }
    page(e) {
        const { page } = e.dataset;
        if (page) {
            removeQuery('page')
            appendQuery('page', page)
            document.location.href = window.location.href

        }

    }
    dev_id(e) {
        const { dev_id } = e.dataset;
        if (dev_id) {
            removeQuery('dev_id')
            document.location.href = window.location.href
        }

    }
    filter_properties(elem) {
        let filters = []
        for (let i = 0; i < elem.length; i++) {
            if (elem[i].getAttribute('data-action') != null && elem[i].value) {
                filters.push({ type: elem[i].getAttribute('data-action'), value: elem[i].value })
            }
        }

        console.log("filters", filters)
        document.location.href = filterSidebar(filters);

    }
    onClick(e) {
        let { action } = e.target.dataset;
        if (action) {
            this[action](e.target.parentElement);
        }
    }
}
