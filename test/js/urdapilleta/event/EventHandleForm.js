import {appendQuery, getParams, removeQuery} from '../actions/UrlQuery'
import {notFoundProperties} from '../services/sendForm'
import {actionUpdateButtonMore} from "../actions/updateProperties";
import {actionUpdateButtonMoreDevelopment} from "../actions/updateDevelopments";


export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)
    }
    remove(e) {
        const {query, value} = e.dataset;
        if (query) {
            removeQuery(query, value)
            document.location.href = window.location.href
        }
    }
    submitSearch(e) {
        const {page} = e.dataset;

        const HOST = `${location.protocol}//${location.host}`;
        const url = {
            url: `${HOST}/api/search${document.location.pathname}${document.location.search}${(document.location.search.indexOf('?')==-1) ? '?':'&'}`,
        };
        notFoundProperties(url).then((result) => {

        }).catch(e => {
            console.log(e);
        })
    }
    onClick(e) {
        let {action} = e.target.dataset
        if (action) {
            this[action](e.target)
            let a = getParams()
        }
    }


}
