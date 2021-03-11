import request from './request.js'

const HOST = `${location.protocol}//${location.host}`;

const url = {

    url: `${HOST}/api/location_property/`,

}

export let getSearchListLocation = (options = url) => {

    return request(options).then(data => {

        return JSON.parse(data);
    })

}

