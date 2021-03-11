import {appendQuery, getParams, removeQuery} from '../actions/UrlQuery'

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)
    }

    removeGetQuery() {
        removeQuery('tipo_propiedad');
        removeQuery('tipo_operacion');
        removeQuery('ambientes');
        removeQuery('dormitorios');
        removeQuery('price_type');
        removeQuery('price_from');
        removeQuery('price_to');
        removeQuery('surface_type');
        removeQuery('surface_from');
        removeQuery('surface_to');

    }

    sublocation(e) {
        this.removeGetQuery();
        if (e.checked) {
            appendQuery('sublocation', e.value)
        } else {
            removeQuery('sublocation', e.value)
        }

    }

    location(e) {
        this.removeGetQuery();
        if (e.checked) {
            appendQuery('location', e.value)
        } else {
            removeQuery('location', e.value)
        }

    }

    propertyType(e) {

        if (e.checked) {
            appendQuery('tipo_propiedad', e.value)
        } else {
            removeQuery('tipo_propiedad', e.value)
        }

    }

    operationType(e) {

        if (e.checked) {
            appendQuery('tipo_operacion', e.value)
        } else {
            removeQuery('tipo_operacion', e.value)
        }
    }

    room(e) {
        removeQuery('ambientes');
        if (e.checked) {
            Array.from(document.querySelectorAll(`.room-checkbox`)).map((item) => {
                item.checked = false;
            });
            e.checked = true;
            appendQuery('ambientes', e.value)
        }
    }

    suite(e) {
        removeQuery('dormitorios');
        if (e.checked) {
            Array.from(document.querySelectorAll(`.suite-checkbox`)).map((item) => {
                item.checked = false;
            });
            e.checked = true;
            appendQuery('dormitorios', e.value)
        }
    }

    onClick(e) {

        let {action} = e.target.dataset;
        if (action) {
            this[action](e.target);
            removeQuery('page');
            document.location.href = window.location.href
        }
    }


}
