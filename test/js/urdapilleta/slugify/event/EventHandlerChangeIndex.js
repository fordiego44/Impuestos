import {appendQuerySlugify} from "../actions/querySluglify";

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onchange = this.onChange.bind(this)

    }

    operation_type(e) {

            // removeQuery('tipo_operacion')
        appendQuerySlugify('tipo_operacion', e.value)
    }

    property_type(e) {

            // removeQuery('tipo_propiedad')
        appendQuerySlugify('tipo_propiedad', e.value)
    }

    onChange(e) {
        let {actionChange} = e.target.dataset
        if (actionChange) {
            this[actionChange](e.target)
        }
    }

}
