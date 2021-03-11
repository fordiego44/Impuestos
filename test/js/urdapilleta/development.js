import EventHandlerClick from './event/development/EventHandleClick'
import FilterActive from "./user-interface/DevelopmentFilterActive";
import EventHandlerClickPage from "./event/EventHandleClickPage";

import { saveDecodeSlugify } from "./slugify/actions/decodeSlugify";

import { actionUpdateButtonMoreDevelopment } from "./actions/updateDevelopments";

document.addEventListener("DOMContentLoaded", function (event) {

    new EventHandlerClick(document.getElementById('filter-development'));

    let filterActive = new FilterActive('filter-active', 'Filtros Activos')

    filterActive.appentToElement('filters-active');

    new EventHandlerClickPage(document.getElementById('filters-active'));

    new EventHandlerClickPage(document.getElementById('casaroyal_ajax_load_more'));
    //
    new EventHandlerClickPage(document.getElementById('filters-active'));
    //
    actionUpdateButtonMoreDevelopment()

});
