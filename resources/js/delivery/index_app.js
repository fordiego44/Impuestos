import { getSearchParameter } from './services/parameterSearch'
import Li from './user-interface/Li';
import { appendQuery } from "./slug/querySluglify";
import { getQueriesForIndex } from "./slug/getQueries";


const HOST = `${location.protocol}//${location.host}`;

localStorage.removeItem('parameter_search_tacna');

getSearchParameter({
    url: `${HOST}/api/parameter_search`,
}).then((result) => {
    localStorage.setItem("parameter_search_tacna", JSON.stringify(result));
})

document.addEventListener("DOMContentLoaded", function (event) {
    if (document.getElementById('search-list')) {

        document.getElementById('search-list').addEventListener('mouseover', function (e) {
            const { target: { dataset: { search, id, name, type, type_filter } } } = e;

            if (search === 'location') {
                const locationSearch = document.getElementById('params-search');
                const type_ = document.getElementById('type');

                locationSearch.value = name;
                locationSearch.dataset.id = id;
                locationSearch.dataset.type = type;
                locationSearch.dataset.name = name;

                type_.value = type_filter;
            }
        });

    }
    if (document.getElementById('params-search')) {

        document.getElementById('params-search').addEventListener("input", function (e) {
            const { target: { value } } = e;

            const showingLocation = value === '' ? '' : JSON.parse(localStorage.getItem('parameter_search_tacna'))
                .filter(c => (c.filter_name.toString().toLowerCase().includes(value.toLowerCase())))
                .slice(0, 7);

            let liTags = new Li('params-search', 'Location Filters', showingLocation);


            liTags.appentToElement('search-list');

        });
    }
    document.querySelector('form').addEventListener('submit', function (e) {

        e.preventDefault();
        e.stopPropagation();
        const queries = getQueriesForIndex();
        window.location.href = appendQuery(queries)

    })
});
