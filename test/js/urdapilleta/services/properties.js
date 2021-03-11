import request from './request.js'

const HOST = `${location.protocol}//${location.host}`;

const url = {

    url: `${HOST}/api/property${document.location.search}`,

}

export let findAllProperties = (options = url) => {
    return request(options).then(data => data = JSON.parse(data))

}
