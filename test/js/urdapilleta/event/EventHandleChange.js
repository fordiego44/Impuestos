import {appendQuery, getParams, removeQuery} from '../actions/UrlQuery'

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onchange = this.onChange.bind(this)

    }

    currencyType(e) {
        const {price_type} = getParams();
        if (price_type) {
            removeQuery('price_type')
            appendQuery('price_type', e.value)
        }
    }

    currencyFrom(e) {
        const {price_type, price_from, price_to} = getParams();
        if(!price_to) removeQuery('price_type');
        if (e.value === '') {
            removeQuery('price_from');
            return;
        }
        const priceType = document.getElementsByName('currency_type')[0].value
        if (!price_type) appendQuery('price_type', priceType);
        if (price_from) removeQuery('price_from');
        appendQuery('price_from', e.value)

    }

    currencyTo(e) {
        const {price_type, price_from, price_to} = getParams();

        if (e.value === '') {
            removeQuery('price_to');
            if(!price_from) removeQuery('price_type');
            return;
        }
        const priceType = document.getElementsByName('currency_type')[0].value
        if (!price_type) appendQuery('price_type', priceType);
        if (price_to) removeQuery('price_to');
        appendQuery('price_to', e.value)


    }

    surfaceType(e) {
        const {surface_type} = getParams();
        if (surface_type) {
            removeQuery('surface_type')
            appendQuery('surface_type', e.value)
        }

    }

    surfaceTo(e) {
        const {surface_to, surface_from, surface_type} = getParams();

        if (e.value === '') {
            removeQuery('surface_to');
            if(!surface_from) removeQuery('surface_type');
            return;
        }
        const surfaceType = document.getElementsByName('surface_type')[0].value
        if (!surface_type) appendQuery('surface_type', surfaceType);
        if (surface_to) removeQuery('surface_to');
        appendQuery('surface_to', e.value)

    }

    surfaceFrom(e) {
        const {surface_to, surface_from, surface_type} = getParams();
        if (e.value === '') {
            removeQuery('surface_from');
            if(!surface_to) removeQuery('surface_type');
            return;
        }
        const surfaceType = document.getElementsByName('surface_type')[0].value
        if (!surface_type) appendQuery('surface_type', surfaceType);
        if (surface_from) removeQuery('surface_from');
        appendQuery('surface_from', e.value)

    }

    onChange(e) {
        let {actionChange} = e.target.dataset
        if (actionChange) {
            this[actionChange](e.target)
            let buttonFilterMobile = document.getElementById('filter-nav')
            let x = window.getComputedStyle(buttonFilterMobile, null).getPropertyValue("display");
            removeQuery('page');
            if (x === 'none') {
                document.location.href = window.location.href
            }

        }
    }

}
