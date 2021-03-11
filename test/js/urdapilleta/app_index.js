import EventHandlerChange from './slugify/event/EventHandlerChangeIndex'
import { appendQuerySlugify } from "./slugify/actions/querySluglify";

import { getQueriesForIndex } from "./slugify/actions/getQueries";



document.addEventListener("DOMContentLoaded", function (event) {
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const queries = getQueriesForIndex();


        window.location.href = appendQuerySlugify(queries)
    })
})
