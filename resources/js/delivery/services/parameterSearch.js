import request from './request.js'

const HOST = `${location.protocol}//${location.host}`;


export let getSearchParameter = (options) => {

    return request(options).then(data => {

        return JSON.parse(data);
    })

}

