import { appendQuery, getParams, removeQuery } from '../actions/UrlQuery'
import { findAllProperties } from '../services/properties'
import { actionUpdateButtonMore } from "../actions/updateProperties";
import { actionUpdateButtonMoreDevelopment } from "../actions/updateDevelopments";
import { keys } from "../dataTokko";

import Item from '../user-interface/Item'
import ItemDevelopment from "../user-interface/ItemDevelopment";

export default class EventHandler {
    constructor(elem) {
        this._element = elem;
        elem.onclick = this.onClick.bind(this)
    }
    remove(e) {
        const { query, value } = e.dataset;

        if (query) {
            removeQuery(query, value)
            document.location.href = window.location.href

        }

    }
    properties(e) {
        const { page } = e.dataset;
        const currentPage = document.getElementsByName('meta_current_page')[0].value;
        const lastPage = document.getElementsByName('meta_last_page')[0].value
        if ((parseInt(currentPage) + 1) > parseInt(lastPage)) {
            return false;
        }
        let url;
        const HOST = `${location.protocol}//${location.host}`;
        let name = document.location.pathname.split('-en-')

        let development = keys.developmentTest(name[2]);
        if (development) {
            url = {
                url: `${HOST}/api/development${document.location.pathname}${document.location.search}${(document.location.search.indexOf('?') == -1) ? '?' : '&'}page=${parseInt(currentPage) + 1}`,

            };
            let elem = document.getElementById('property-more')
            elem.parentNode.removeChild(elem);
            actionUpdateButtonMore({}, 'loading');

            findAllProperties(url).then((result) => {
                const items = new Item(`properties${page}`, 'Prop', result.objects)

                items.insertAfterToElement('properties-list');

                actionUpdateButtonMore(result.meta);
            }).catch(e => {
                console.log(e);
            })
        } else {
            url = {
                url: `${HOST}/api/property${document.location.pathname}${document.location.search}${(document.location.search.indexOf('?') == -1) ? '?' : '&'}page=${parseInt(currentPage) + 1}`,

            };
            let elem = document.getElementById('property-more')
            elem.parentNode.removeChild(elem);
            actionUpdateButtonMore({}, 'loading');

            findAllProperties(url).then((result) => {
                const items = new Item(`properties${page}`, 'Prop', result.objects)

                items.insertAfterToElement('properties-list');

                actionUpdateButtonMore(result.meta);
            }).catch(e => {
                console.log(e);
            })
        }
    }
    developments(e) {
        const { page } = e.dataset;

        const currentPage = document.getElementsByName('meta_current_page')[0].value;
        const lastPage = document.getElementsByName('meta_last_page')[0].value
        if ((parseInt(currentPage) + 1) > parseInt(lastPage)) {
            return false;
        }
        const HOST = `${location.protocol}//${location.host}`;
        const url = {

            url: `${HOST}/api/development${document.location.search}${(document.location.search.indexOf('?') == -1) ? '?' : '&'}page=${parseInt(currentPage) + 1}`,

        }

        let elem = document.getElementById('property-more')
        elem.parentNode.removeChild(elem);
        actionUpdateButtonMoreDevelopment({}, 'loading');
        findAllProperties(url).then((result) => {
            const items = new ItemDevelopment(`properties${page}`, 'Prop', result.objects)
            items.insertAfterToElement('properties-list');
            actionUpdateButtonMoreDevelopment(result.meta);

        }).catch((e) => {
            console.log(e);
        })
    }
    onClick(e) {
        let { action } = e.target.dataset
        if (action) {
            this[action](e.target)
            let a = getParams()
        }
    }
}
