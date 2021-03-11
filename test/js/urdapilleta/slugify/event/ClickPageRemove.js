import {appendQuerySlugify, removeQuerySlugify, removeQuery} from "../actions/querySluglify";
import {keys} from "../../dataTokko";

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)
    }

    remove(elem) {
        const {dataset: {value, query, remove}} = elem;
        // if(remove == 'sublocation'){
        //     window.location.href = removeQuery(query,value);
        // }else{
        // window.location.href= removeQuerySlugify(query,remove);
        // }
        // if(query == 'tipo_propiedad' && (value == 'casa' || value == 'ph')){
        //
        //     const params = JSON.parse(sessionStorage.getItem('params_url'))
        //     const valTypeProperty = (params instanceof Array) ?
        //         (
        //             () => params.filter(v => v.some(a => a.type == 'tipo_propiedad')).shift() || []
        //         )().shift() || {} : {};

        //
        //     if(['13-3','3-13'].includes(valTypeProperty.value)){
        //         if(value == '13'){
        //
        //             // window.location.href= removeQuerySlugify(query,remove);
        //
        //
        //         }else{
        //
        //
        //
        //         }
        //     }
        //
        // }else {
        //     const d = removeQuerySlugify(query,remove);

        //     return false;
            window.location.href= removeQuerySlugify(query,remove);

        // }

    }

    onClick(e) {
        let {action} = e.target.dataset;
        if (action) {
            this[action](e.target);
            // document.location.href = window.location.href
        }
    }
}
