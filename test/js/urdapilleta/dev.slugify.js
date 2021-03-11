
import FilterActive from './slugify/user-interface/LiActive'
import EventHandlerClickPage from './event/EventHandleClickPage'
import EventHandlerNoProperties from './event/EventHandlerNoProperties'

import { actionUpdateButtonMore } from "./actions/updateProperties";
import { saveDecodeSlugify } from "./slugify/actions/decodeSlugify";
import { getSearchListLocation } from "./services/locationSearch";
import ClickSidebarFilter from './slugify/event/ClickSidebarFilter'
import ClickPageRemove from './slugify/event/ClickPageRemove'

const HOST = `${location.protocol}//${location.host}`;


document.addEventListener("DOMContentLoaded", async function (event) {

    if (localStorage.getItem('locations_property') === null) {

        const locations = await getSearchListLocation({

            url: `${HOST}/api/location_property/all`,

        });

        localStorage.setItem("locations_property", JSON.stringify(locations.map(l => {
            if (l.type == '1Ciudad') {
                l.type_title = 'Todo';
            } else {
                l.type_title = '';
            }
            return l;
        })));
        localStorage.setItem('locations_property_commercial', JSON.stringify(locations.filter(loc =>
            [25818, 25469, 25620, 25127, 24820].includes(+loc.location_id))))
    }

    const paramsOfSlugify = saveDecodeSlugify();


    let filterActive = new FilterActive('filter-active', 'Filtros Activos', paramsOfSlugify);
    filterActive.appentToElement('filters-active');


    new ClickSidebarFilter(document.getElementById('filters-form'));
    new ClickPageRemove(document.getElementById('filters-active'));
    new EventHandlerClickPage(document.getElementById('casaroyal_ajax_load_more'));
    actionUpdateButtonMore();
    new EventHandlerNoProperties(document.getElementById('no-property-form'));
});
