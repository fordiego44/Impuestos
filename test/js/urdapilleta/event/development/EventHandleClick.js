import {appendQuery, getParams, removeQuery} from '../../actions/UrlQuery'

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)

    }

    removeGetQuery() {
        removeQuery('branch')
        removeQuery('location');
        removeQuery('status');

    }

    location(e) {

        const {dataset: {locationId}} = e;
        removeQuery('location')
        appendQuery('location', locationId)

    }

    status(e) {
        const {dataset: {statusId}} = e;
        removeQuery('status')
        appendQuery('status', statusId)

    }


    branch(e) {
        const {dataset: {branchId}} = e;
        removeQuery('branch')
        appendQuery('branch', branchId)

    }

    onClick(e) {

        let {action} = e.target.dataset
        if (action && action != 'remove') {
            this[action](e.target)
            removeQuery('page');
            document.location.href = window.location.href
        }
    }


}
