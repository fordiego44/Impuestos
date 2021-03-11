import { getSearchListLocation } from './services/locationSearch'
import LiLocation from './user-interface/location/Li';


import { getQueriesForIndex } from "./slugify/actions/getQueries";
import { appendQuerySlugify } from "./slugify/actions/querySluglify";

const HOST = `${location.protocol}//${location.host}`;

localStorage.removeItem('barrios_property');

if (localStorage.getItem('barrios_property') === null) {
    getSearchListLocation({
        url: `${HOST}/api/location_property/all-barrios`,
    }).then((result) => {
        localStorage.setItem("barrios_property", JSON.stringify(result.map(l => {
            if (l.type == '1Ciudad') {
                l.type_title = 'Todo';
            } else {
                l.type_title = '';
            }
            return l;
        })));
    })
}

localStorage.removeItem('barrios_development');

if (localStorage.getItem('barrios_development') === null) {
    getSearchListLocation({
        url: `${HOST}/api/location_development/all`,
    }).then((result) => {
        localStorage.setItem("barrios_development", JSON.stringify(result.map(l => {
            if (l.type == '1Ciudad') {
                l.type_title = 'Todo';
            } else {
                l.type_title = '';
            }
            return l;
        })));

    })
}

document.addEventListener("DOMContentLoaded", function (event) {

    if (document.getElementById('location-search-list')) {

        document.getElementById('location-search-list').addEventListener('mouseover', function (e) {
            const { target: { dataset: { search, id, name, fullname } } } = e;

            if (search === 'location') {
                const locationSearch = document.getElementById('location-search');

                locationSearch.value = fullname;
                locationSearch.dataset.id = id;
                locationSearch.dataset.name = name;

            }
        });

    }
    if (document.getElementById('locations_data')) {

        document.getElementById('locations_data').addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const { target: { dataset: { search, id, name, fullname, type } } } = e;
            console.log('te', search);
            if (type === 'development') {

                const locationSearch = document.getElementById('data-location-search');
                locationSearch.value = fullname;
                locationSearch.dataset.id = id;
                locationSearch.dataset.name = name;
                window.location.href = appendQuerySlugify('location', name)

            } else {
                const locationSearch = document.getElementById('data-location-search');
                locationSearch.value = fullname;
                locationSearch.dataset.id = id;
                locationSearch.dataset.name = name;
                window.location.href = appendQuerySlugify('sublocation', name)
            }

        });

    }

    const locationsPropertyCommercial = JSON.parse(localStorage.getItem('locations_property_commercial'));
    if (document.getElementById('location-search')) {

        document.getElementById('location-search').addEventListener("input", function (e) {

            const typePropertyElem = document.getElementById('tipo_propiedad');

            if (!['terrenos_comerciales', 'local', 'oficina'].includes(typePropertyElem.value)) {

                const { target: { value } } = e;
                let new_value = value;

                const showingLocation = new_value === ''
                    ? ''
                    : JSON.parse(localStorage.getItem('barrios_property'))
                        .filter(c => (c.short_name.toLowerCase().includes(new_value.toLowerCase())))
                        .sort((a, b) => a.type > b.type ? 1 : -1)
                        .slice(0, 5);

                const showingDevelpment = new_value === ''
                    ? ''
                    : JSON.parse(localStorage.getItem('barrios_development'))
                        .filter(c => (c.name.toLowerCase().includes(new_value.toLowerCase())))
                        .sort((a, b) => a.type > b.type ? 1 : -1)
                        .slice(0, 5);

                let liTags = new LiLocation('location-search', 'Location Filters', showingLocation, showingDevelpment);
                liTags.appentToElement('location-search-list');

            } else {
                const liTags = new LiLocation('location-search', 'Location Filters', locationsPropertyCommercial);

                liTags.appentToElement('location-search-list');

            }
        });

    }
    if (document.getElementById('data-location-search')) {
        const params = JSON.parse(sessionStorage.getItem('params_url'))
        const valTypeProperty = (params instanceof Array) ?
            (() => params.filter(v => v.some(a => a.type == 'tipo_propiedad')).shift() || []
            )().shift() || {} : {}

        document.getElementById('data-location-search').addEventListener("input", function (e) {
            if ([8, 7, 5].includes(+valTypeProperty.value)) {

                const liTags = new LiLocation('location-search', 'Location Filters', locationsPropertyCommercial);
                liTags.appentToElement('locations_data');

            } else {

                const { target: { value } } = e;
                const showingLocation = value === '' ? '' : JSON.parse(localStorage.getItem('barrios_property'))
                    .filter(c => (c.short_name.toLowerCase().includes(value.toLowerCase())))
                    .sort((a, b) => a.type > b.type ? 1 : -1)
                    .slice(0, 5);

                const showingDevelpment = value === ''
                    ? ''
                    : JSON.parse(localStorage.getItem('barrios_development'))
                        .filter(c => (c.name.toLowerCase().includes(value.toLowerCase())))
                        .sort((a, b) => a.type > b.type ? 1 : -1)
                        .slice(0, 5);

                let liTags = new LiLocation('location-search', 'Location Filters', showingLocation, showingDevelpment);
                liTags.appentToElement('locations_data');
            }
        });
    }
});
