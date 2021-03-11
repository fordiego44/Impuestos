import request from './request.js'
import {pretierSummaryJSON} from './pretierSummary.js'

const HOST = `${location.protocol}//${location.host}`;

const url = {

    // url: `${HOST}/api/property/filter${document.location.search}`,
    url: `${HOST}/api/property/filter`,

}

const urlFilter = {

    url: `${HOST}/api/property/filter`,

}

export let getAllSummaryProperties = (options = urlFilter) => {

    return request(options).then(data => {

        return pretierSummaryJSON(data);
    })

}

export let getSummaryProperties = (options = url) => {

    return request(options).then(data => {
        return pretierSummaryJSON(data);
    })

}
